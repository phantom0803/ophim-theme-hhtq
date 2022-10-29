@extends('themes::themehhtq.layout')

@php
    $years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
        return \Ophim\Core\Models\Movie::select('publish_year')
            ->distinct()
            ->pluck('publish_year')
            ->sortDesc();
    });
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="myui-panel myui-panel-bg2 clearfix">
                <div class="myui-panel-box clearfix">
                    <div class="myui-panel_hd">
                        <div class="myui-panel__head active bottom-line clearfix">
                            <a class="slideDown-btn more pull-right" href="javascript:;">Thu gọn <i
                                    class="fa fa-angle-up"></i></a>
                            <h3 class="title">Lọc Phim </h3>
                        </div>
                    </div>

                    <div class="myui-panel_bd">
                        <div class="slideDown-box">
                            <form id="form-search" class="form-inline" method="GET" action="/">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <select class="form-control select_filter" id="category" name="filter[category]" form="form-search">
                                            <option value="">Tất cả thể loại</option>
                                            @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                                                <option value="{{ $item->id }}" @if ((isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                                                    (isset($category) && $category->id == $item->id)) selected @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <select class="form-control select_filter" name="filter[region]" form="form-search">
                                            <option value="">Tất cả quốc gia</option>
                                            @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                                                <option value="{{ $item->id }}" @if ((isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                                                    (isset($region) && $region->id == $item->id)) selected @endif>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <select class="form-control select_filter" name="filter[year]" form="form-search">
                                            <option value="">Tất cả năm</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" @if (isset(request('filter')['year']) && request('filter')['year'] == $year) selected @endif>
                                                    {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <select class="form-control select_filter" id="sort" name="filter[sort]" form="form-search">
                                            <option value="">Sắp xếp</option>
                                            <option value="update" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>Thời gian cập nhật</option>
                                            <option value="create" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>Thời gian đăng</option>
                                            <option value="year" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>Năm sản xuất</option>
                                            <option value="view" @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>Lượt xem</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <select class="form-control select_filter" id="type" name="filter[type]" form="form-search">
                                            <option value="">Mọi định dạng</option>
                                            <option value="series" @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') selected @endif>Phim bộ</option>
                                            <option value="single" @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') selected @endif>Phim lẻ</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-2 col-sm-3 col-md-6">
                                        <button class="btn btn-primary button_filter" form="form-search" type="submit">Lọc Phim</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="myui-panel active myui-panel-bg clearfix">
                <div class="myui-panel-box clearfix">
                    <div class="myui-panel_bd">
                        <div class="myui-panel__head clearfix">
                            <h3 class="title">{{$section_name}}</h3>
                        </div>
                        @if (count($data))
                            <ul class="myui-vodlist clearfix">
                                @foreach ($data as $movie)
                                <li class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                    @include('themes::themehhtq.inc.movie_card')
                                </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Không tìm thấy phim trong mục này</p>
                        @endif

                        {{ $data->appends(request()->all())->links('themes::themehhtq.inc.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
