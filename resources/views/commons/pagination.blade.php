@if ($paginator->hasPages())
    <ul class="common-pagination d-flex justify-content-center list-unstyled">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a class="text-black"> <i class="iconsminds-left"></i></a>
            </li>
        @else
            <li class="d-flex ">
                <a class="text-black" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i  class="iconsminds-left"></i>
                </a>
            </li>
        @endif
        @if($paginator->currentPage() > 2)
            <li class="hidden-xs"><a class="text-black" href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li><a class="text-black">...</a></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <li class="active text-white"><a class="active">{{ $i }}</a></li>
                @else
                    <li><a class="text-black" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li><a class="text-black">...</a></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="hidden-xs"><a class="text-black"
                                     href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="text-black" href="{{ $paginator->nextPageUrl() }}" rel="next"> <i class="iconsminds-right"></i></a></li>
        @else
            <li class="disabled"><a class="text-black"> <i class="iconsminds-right"></i></a></li>
        @endif
    </ul>
@endif
@push('style')
    <style>
        .common-pagination li {
            border-radius: 50%;
            margin-left: 5px;
            display: flex;
            justify-content: center;
            height: 40px;
            width: 40px;
        }

        .common-pagination li a {
            padding: 3px;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            align-self: center;
        }

        li.active {
            background: #ed7117;
            border: none;
        }
    </style>
@endpush
