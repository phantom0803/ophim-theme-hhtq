<div class="myui-panel myui-panel-bg clearfix">
    <div class="myui-panel-box clearfix">
        <div class="myui-panel_hd">
            <div class="myui-panel__head active bottom-line clearfix">
                <h3 class="title">Có thể bạn sẽ thích</h3>
            </div>
        </div>
        <div class="tab-content myui-panel_bd">
            <ul class="myui-vodlist__bd tab-pane fade in active clearfix">
                @foreach ($movie_related as $movie)
                    <li class="col-lg-5 col-md-6 col-sm-4 col-xs-3">
                        @include('themes::themehhtq.inc.movie_card')
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
