<div class="myui-panel radius-0 clearfix" id="index-hot" style="padding: 15px 0;">
    <div class="myui-panel-box clearfix">
        <div class="myui-panel_bd col-pd">
            <div class="container">
                <div class="row">
                    <div class="flickity active clearfix" data-align="left" data-next="1" data-play="1500">
                        @foreach ($recommendations as $movie)
                            <div class="col-lg-6 col-md-6 col-sm-4 col-xs-3">
                                @include('themes::themehhtq.inc.movie_card')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
