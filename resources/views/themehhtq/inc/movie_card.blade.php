<div class="myui-vodlist__box">
    <a href="{{ $movie->getUrl() }}" class="myui-vodlist__thumb" title="{{ $movie->name }}"
        style="background: url({{ $movie->thumb_url }});">
        <span class="play hidden-xs"></span>
        <span class="pic-tag pic-tag-top" style="background-color: #00000066;">{{$movie->episode_current}}</span></a>
    <div class="myui-vodlist__detail">
        <h4 class="title text-overflow">
            <a class="text-fff" href="{{ $movie->getUrl() }}" title="{{ $movie->name }}">{{ $movie->name }}</a>
        </h4>
        <p class="text text-overflow text-muted hidden-xs">{{ $movie->origin_name }} ({{$movie->publish_year}})</p>
    </div>
</div>
