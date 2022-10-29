@if ($paginator->hasPages())
    <ul class="myui-page">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <li class="num">
                <a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')"><i class="icon-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="num disabled" aria-disabled="true"><span class="">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="num" aria-current="page"><a
                                class="active">{{ $page }}</a></li>
                    @else
                        <li class="num"><a class="" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="num">
                <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="@lang('pagination.next')"><i class="icon-right"></i></a>
            </li>
        @else
        @endif
    </ul>
@endif
