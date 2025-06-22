<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-gray-800 bg-gray-100">
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="bg-white rounded-2xl p-4 border border-gray-600 mb-4">
        <h1 class="text-2xl font-bold text-center">MANAJEMEN PRODUK TOKO</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Export -->
    <div class="flex justify-between items-center mb-4">       
        <button onclick="openModal()" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Produk</button>
        
        <div class="space-x-2">
            <a href="/produk/export/pdf?search={{ $search }}&sortBy={{ $sortBy }}&sortDir={{ $sortDir }}" 
            class="bg-red-600 text-white px-4 py-2 rounded">Export PDF</a>

            <a href="/produk/export/xlsx?search={{ $search }}&sortBy={{ $sortBy }}&sortDir={{ $sortDir }}" 
            class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</a>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="/" class="flex items-center" id="perPageForm">
            <select name="perPage" onchange="document.getElementById('perPageForm').submit()" 
                    class="border px-3 py-2 rounded">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5 </option>
                <option value="10" {{ request('perPage') == 10 || !request('perPage') ? 'selected' : '' }}>10 </option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20 </option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 </option>
                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100 </option>
            </select>
            <input type="hidden" name="search" id="searchInput" value="{{ $search }}">
            <input type="hidden" name="sortBy" value="{{ $sortBy }}">
            <input type="hidden" name="sortDir" value="{{ $sortDir }}">
        </form>

        <div class="relative">
            <input type="text" id="liveSearch" placeholder="Cari..." value="{{ $search }}"
                   class="border px-3 py-2 rounded w-64" oninput="handleSearch()">
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>


    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">
                    <a href="?sortBy=nama&sortDir={{ $sortBy === 'nama' && $sortDir === 'asc' ? 'desc' : 'asc' }}&search={{ $search }}"
                       class="flex items-center sortable">
                        Nama
                        <span class="sort-icon ml-1 {{ $sortBy === 'nama' ? 'active' : '' }}">
                            @if($sortBy === 'nama')
                                {{ $sortDir === 'asc' ? '▲' : '▼' }}
                            @else
                                ↕
                            @endif
                        </span>
                    </a>
                </th>
                <th class="px-4 py-2 text-left w-80">
                    <a href="?sortBy=deskripsi&sortDir={{ $sortBy === 'deskripsi' && $sortDir === 'asc' ? 'desc' : 'asc' }}&search={{ $search }}"
                       class="flex items-center sortable">
                        Deskripsi
                        <span class="sort-icon ml-1 {{ $sortBy === 'deskripsi' ? 'active' : '' }}">
                            @if($sortBy === 'deskripsi')
                                {{ $sortDir === 'asc' ? '▲' : '▼' }}
                            @else
                                ↕
                            @endif
                        </span>
                    </a>
                </th>
                <th class="px-4 py-2 text-left">
                    <a href="?sortBy=harga&sortDir={{ $sortBy === 'harga' && $sortDir === 'asc' ? 'desc' : 'asc' }}&search={{ $search }}"
                       class="flex items-center sortable">
                        Harga
                        <span class="sort-icon ml-1 {{ $sortBy === 'harga' ? 'active' : '' }}">
                            @if($sortBy === 'harga')
                                {{ $sortDir === 'asc' ? '▲' : '▼' }}
                            @else
                                ↕
                            @endif
                        </span>
                    </a>
                </th>
                <th class="px-4 py-2 text-left">
                    <a href="?sortBy=stok&sortDir={{ $sortBy === 'stok' && $sortDir === 'asc' ? 'desc' : 'asc' }}&search={{ $search }}"
                       class="flex items-center sortable">
                        Stok
                        <span class="sort-icon ml-1 {{ $sortBy === 'stok' ? 'active' : '' }}">
                            @if($sortBy === 'stok')
                                {{ $sortDir === 'asc' ? '▲' : '▼' }}
                            @else
                                ↕
                            @endif
                        </span>
                    </a>
                </th>
                <th class="px-4 py-2 text-center w-56">Aksi</th>
            </tr>
            </thead>
        <tbody>
        @forelse($produks as $produk)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $loop->iteration }}</td> <!-- No -->
                <td class="px-4 py-2">{{ $produk->nama }}</td>
                <td class="px-4 py-2">{{ $produk->deskripsi }}</td>
                <td class="px-4 py-2">Rp {{ number_format($produk->harga, 0) }}</td>
                <td class="px-4 py-2">{{ $produk->stok }}</td>
                <!-- <td class="px-4 py-2">{{ $produk->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-2">{{ $produk->updated_at->format('d/m/Y') }}</td> -->
                <td class="px-4 py-2 text-center space-x-1">
                    <button onclick='showDetail(@json($produk))'
                            class="text-sm bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded">Detail</button>
                    <button onclick='openModal(@json($produk))'
                            class="text-sm bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Edit</button>
                    <form method="POST" action="/produk/{{ $produk->id }}" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf @method('DELETE')
                        <button class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center py-4">Tidak ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>


    @include('produk._pagination', ['produks' => $produks, 'search' => $search, 'sortBy' => $sortBy, 'sortDir' => $sortDir])
</div>

@include('produk._modal')
@include('produk._detail')

<script>
    function openModal(data = null) {
        const modal = document.getElementById('modalProduk');
        const form = document.getElementById('formProduk');
        document.getElementById('modalTitle').textContent = data ? 'Edit Produk' : 'Tambah Produk';
        form.action = data ? `/produk/${data.id}` : '/produk';
        document.getElementById('formMethod').value = data ? 'PUT' : 'POST';

        document.getElementById('nama').value = data?.nama || '';
        document.getElementById('deskripsi').value = data?.deskripsi || '';
        document.getElementById('harga').value = data?.harga || '';
        document.getElementById('stok').value = data?.stok || '';

        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalProduk').classList.add('hidden');
    }

    function showDetail(data) {
        document.getElementById('detail_nama').textContent = data.nama;
        document.getElementById('detail_deskripsi').textContent = data.deskripsi || '-';
        document.getElementById('detail_harga').textContent = Number(data.harga).toLocaleString('id-ID');
        document.getElementById('detail_stok').textContent = data.stok;
        document.getElementById('detail_created_at').textContent = new Date(data.created_at).toLocaleString('id-ID');
        document.getElementById('detail_updated_at').textContent = new Date(data.updated_at).toLocaleString('id-ID');

        document.getElementById('modalDetail').classList.remove('hidden');
    }

    function closeDetail() {
        document.getElementById('modalDetail').classList.add('hidden');
    }

    let searchTimer;
    function handleSearch() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            const searchValue = document.getElementById('liveSearch').value;
            document.getElementById('searchInput').value = searchValue;
            document.getElementById('perPageForm').submit();
        }, 500); // Delay 500ms setelah user berhenti mengetik
    }

    // Submit form saat enter ditekan
    document.getElementById('liveSearch').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const searchValue = document.getElementById('liveSearch').value;
            document.getElementById('searchInput').value = searchValue;
            document.getElementById('perPageForm').submit();
        }
    });
</script>
</body>
</html>