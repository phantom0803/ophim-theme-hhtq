@extends('themes::themehhtq.layout')


@php
    use Ophim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(get_theme_option('recommendations_limit', 10))
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $link] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 12, '']);
                try {
                    $data[] = [
                        'label' => $label,
                        'link' => $link,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@section('content')
    @include('themes::themehhtq.inc.slider_recommended')
    <div class="container">
        <div class="row">
            @foreach ($data as $item)
                <div class="myui-panel myui-panel-bg clearfix">
                    <div class="myui-panel-box clearfix">
                        <div class="myui-panel_bd clearfix">
                            <div class="myui-panel_hd">
                                <div class="myui-panel__head clearfix"><span class="icon icon-cinema"></span>
                                    <h3 class="title">{{$item['label']}}</h3>
                                </div>
                                @if ($item['link'])
                                    <a class="more text-muted" href="{{$item['link']}}">Xem thêm <i class="fa fa-angle-right"></i></a>
                                @endif
                            </div>
                            <ul class="myui-vodlist clearfix">
                                @foreach ($item['data'] as $movie)
                                <li class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                    @include('themes::themehhtq.inc.movie_card')
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
