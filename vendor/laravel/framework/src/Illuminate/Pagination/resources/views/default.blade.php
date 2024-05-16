@if ($paginator->hasPages())
    <center>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a class="btn-disabled  btn btn-sm btn-default">&laquo;</a></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" class="btn-page btn btn-sm btn-default" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><a class="btn btn-sm btn-default">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" ><a class="btn btn-sm btn-success">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}" class="btn btn-page btn-sm btn-default" >{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}"  class="btn btn-page btn-sm btn-default" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span class="btn btn-sm btn-default btn-disabled">&raquo;</span></li>
        @endif
    </ul>
    <input type="hidden" id="current_page" value="{{$paginator->currentPage()}}">
    </center>
@endif
<style type="text/css">
    .pagination > li{
        margin-left: 5px !important;
    }
    .btn-disabled{
        background: #dddddd !important;
    }
    .btn-disabled:hover{
        cursor: not-allowed !important;
    }
</style>
