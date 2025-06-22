<div class="mt-4 flex items-center justify-between">
    <div class="text-sm text-gray-600">
        Menampilkan {{ $produks->firstItem() }} - {{ $produks->lastItem() }} dari {{ $produks->total() }} hasil
        ({{ $produks->perPage() }} per halaman)
    </div>
    
    <div class="flex space-x-1">
        @if ($produks->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">«</span>
        @else
            <a href="{{ $produks->previousPageUrl() }}&search={{ $search }}&sortBy={{ $sortBy }}&sortDir={{ $sortDir }}&perPage={{ $perPage }}" 
               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">«</a>
        @endif

        @foreach ($produks->getUrlRange(1, $produks->lastPage()) as $page => $url)
            @if ($page == $produks->currentPage())
                <span class="px-3 py-1 bg-blue-600 text-white rounded">{{ $page }}</span>
            @else
                <a href="{{ $url }}&search={{ $search }}&sortBy={{ $sortBy }}&sortDir={{ $sortDir }}&perPage={{ $perPage }}" 
                   class="px-3 py-1 bg-white border border-gray-300 text-blue-600 rounded hover:bg-gray-100">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        @if ($produks->hasMorePages())
            <a href="{{ $produks->nextPageUrl() }}&search={{ $search }}&sortBy={{ $sortBy }}&sortDir={{ $sortDir }}&perPage={{ $perPage }}" 
               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">»</a>
        @else
            <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded cursor-not-allowed">»</span>
        @endif
    </div>
</div>