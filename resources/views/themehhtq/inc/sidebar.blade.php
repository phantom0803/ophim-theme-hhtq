<div class="col-md-wide-3 col-xs-1 myui-sidebar hidden-sm hidden-xs">
    <div class="myui-panel myui-panel-bg clearfix">
        <div class="myui-panel-box clearfix">
            <div class="myui-panel_hd">
                <div class="myui-panel__head active clearfix">
                    <h3 class="title">Top {{ $currentMovie->type == 'series' ? 'phim bộ' : 'phim lẻ'}}</h3> <span class="icon icon-cinema"></span>
                </div>
            </div>
            <div class="myui-panel_bd">
                <ul class="myui-vodlist__media active col-pd clearfix">
                    @foreach ($tops as $movie)
                        <li>
                            <div class="thumb">
                                <a class="myui-vodlist__thumb img-xs-70"
                                style="background: url({{$movie->getThumbUrl()}});"
                                href="{{$movie->getUrl()}}" title="{{$movie->name}}"></a>
                            </div>
                            <div class="detail detail-side">
                                <h4 class="title">
                                    <a href="{{$movie->getUrl()}}"><i class="fa fa-angle-right text-muted pull-right"></i> {{$movie->name}}</a>
                                </h4>
                                <h5 class="font-12">{{$movie->origin_name}}</h5>
                                <p class="font-12"><span class="text-muted"> {{$movie->episode_current}}</span></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
