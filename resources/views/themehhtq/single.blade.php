@extends('themes::themehhtq.layout')

@php
    $watch_url = '';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watch_url = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="myui-panel col-pd clearfix">
                <div class="myui-content__thumb">
                    <a class="myui-vodlist__thumb img-md-220 img-sm-220 img-xs-130 picture" href="{{ $watch_url }}"
                        title="{{ $currentMovie->name }}">
                        <img class="lazyload" src="{{ $currentMovie->thumb_url }}"
                            data-original="{{ $currentMovie->thumb_url }}" />
                        <span class="play hidden-xs"></span></a>
                    @if ($watch_url)
                        <div class="imdbpost">
                            <a class="btn btn-primary btn_watch" href="{{ $watch_url }}"><i class="fa fa-play-circle"
                                    aria-hidden="true"></i> Xem Phim</a>
                        </div>
                    @endif
                </div>
                <div class="myui-content__detail">
                    <h1 class="title text-fff">{{ $currentMovie->name }}</h1>
                    <h2 class="font-14">{{ $currentMovie->origin_name }} ({{ $currentMovie->publish_year }})</h2>
                    <div class="box-rating">
                        <input id="hint_current" type="hidden" value="">
                        <input id="score_current" type="hidden"
                            value="{{ number_format($currentMovie->rating_star ?? 0, 1) }}">
                        <div id="star" data-score="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"
                            style="cursor: pointer; float: left; width: 200px;">
                        </div>
                        <span id="hint"></span>
                        <div id="div_average" style="float:left; line-height:20px; margin:0 5px; ">(<span class="average"
                                id="average">{{ number_format($currentMovie->rating_star ?? 0, 1) }}</span> đ/<span
                                id="rate_count"> /
                                {{ $currentMovie->rating_count ?? 0 }}</span> lượt)
                        </div>
                        <meta itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" />
                        <meta itemprop="ratingValue" content="{{ number_format($currentMovie->rating_star ?? 0, 1) }}" />
                        <meta itemprop="ratingcount" content="{{ $currentMovie->rating_count ?? 0 }}" />
                        <meta itemprop="bestRating" content="10" />
                        <meta itemprop="worstRating" content="1" />
                    </div>
                    <div class="myui-panel myui-panel-bg clearfix" id="desc">
                        <div class="myui-panel-box clearfix">
                            <div class="myui-panel_bd">
                                <div class="col-pd text-collapse content">
                                    <ul>
                                        <li>
                                            Trạng thái <span class='quality1'><i class='fa fa-play-circle'
                                                            aria-hidden='true'></i>
                                                        {{ $currentMovie->episode_current }}
                                                        {{ $currentMovie->language }}</span>
                                        </li>
                                        <li>Năm phát hành: <a href=""
                                                rel="tag">{{ $currentMovie->publish_year }}</a>
                                        </li>
                                        <li>Số tập:<span class='episode'> {{ $currentMovie->episode_total }}</span></li>
                                        <li>Quốc gia:
                                            {!! $currentMovie->regions->map(function ($region) {
                                                    return '<a href="' .
                                                        $region->getUrl() .
                                                        '" title="' .
                                                        $region->name .
                                                        '" rel="region tag">' .
                                                        $region->name .
                                                        '</a>';
                                                })->implode(', ') !!}
                                        <li>Thể loại:
                                            {!! $currentMovie->categories->map(function ($category) {
                                                    return '<a href="' .
                                                        $category->getUrl() .
                                                        '" title="' .
                                                        $category->name .
                                                        '" rel="category tag">' .
                                                        $category->name .
                                                        '</a>';
                                                })->implode(', ') !!}
                                        </li>
                                        <li>Đạo diễn:
                                            {!! $currentMovie->directors->map(function ($director) {
                                                    return '<a href="' .
                                                        $director->getUrl() .
                                                        '" title="' .
                                                        $director->name .
                                                        '" rel="director tag">' .
                                                        $director->name .
                                                        '</a>';
                                                })->implode(', ') !!}
                                        </li>
                                        <li>Diễn viên:
                                            {!! $currentMovie->actors->map(function ($actor) {
                                                    return '<a href="' .
                                                        $actor->getUrl() .
                                                        '" title="' .
                                                        $actor->name .
                                                        '" rel="actor tag">' .
                                                        $actor->name .
                                                        '</a>';
                                                })->implode(', ') !!}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-wide-7 col-xs-1 padding-0">
                <div class="myui-panel myui-panel-bg clearfix" id="desc">
                    <div class="myui-panel-box clearfix">
                        <div class="myui-panel_hd">
                            <div class="myui-panel__head active bottom-line clearfix">
                                <h3 class="title">Nội dung chi tiết</h3>
                            </div>
                        </div>
                        <div class="myui-panel_bd">
                            <div class="col-pd text-collapse content">
                                <span class="sketch content">
                                    @if ($currentMovie->content)
                                        {!! $currentMovie->content !!}
                                    @else
                                        <p>Hãy xem phim để cảm nhận nhé</p>
                                    @endif
                                </span>
                                <div class="the_tag_list">
                                    @foreach ($currentMovie->tags as $tag)
                                        <a href="{{ $tag->getUrl() }}" rel="tag">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="myui-panel myui-panel-bg clearfix">
                    <div class="myui-panel-box clearfix">
                        <div class="myui-panel_hd">
                            <div class="myui-panel__head active bottom-line clearfix">
                                <h3 class="title">Bình luận</h3>
                            </div>
                        </div>

                        <div class="tab-content myui-panel_bd">
                            <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                                data-colorscheme="dark" data-numposts="5" data-order-by="reverse_time" data-lazy="true"></div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(".tab-pane:first,.nav-tabs li:first").addClass("active");
                </script>
                @include('themes::themehhtq.inc.interested')
            </div>
            @include('themes::themehhtq.inc.sidebar')
        </div>
    </div>
@endsection


@push('scripts')
    <link href="{{ asset('/themes/hhtq/libs/jquery-raty/jquery.raty.css') }}" rel="stylesheet" />
    <script src="{{ asset('/themes/hhtq/libs/jquery-raty/jquery.raty.js') }}"></script>

    <script>
        var rated = false;
        jQuery(document).ready(function($) {
            $('#star').raty({
                number: 10,
                starHalf: '/themes/hhtq/libs/jquery-raty/images/star-half.png',
                starOff: '/themes/hhtq/libs/jquery-raty/images/star-off.png',
                starOn: '/themes/hhtq/libs/jquery-raty/images/star-on.png',
                click: function(score, evt) {
                    if (!rated) {
                        $.ajax({
                            url: '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}',
                            data: JSON.stringify({
                                rating: score
                            }),
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function(res) {
                                alert("Đánh giá của bạn đã được gửi đi!")
                                rated = true;
                            }
                        });
                    }
                }
            });
        })
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
