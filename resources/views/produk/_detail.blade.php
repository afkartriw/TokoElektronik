<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50" style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); background-color: rgba(0,0,0,0.2);">
    <div class="bg-white w-full max-w-md rounded-lg p-6 shadow relative">
        <h2 class="text-xl font-bold mb-4">Detail Produk</h2>
        <div class="space-y-2 text-sm">
            <p><strong>Nama:</strong> <span id="detail_nama"></span></p>
            <p><strong>Deskripsi:</strong> <span id="detail_deskripsi"></span></p>
            <p><strong>Harga:</strong> Rp <span id="detail_harga"></span></p>
            <p><strong>Stok:</strong> <span id="detail_stok"></span></p>
            <p><strong>Dibuat:</strong> <span id="detail_created_at"></span></p>
            <p><strong>Diperbarui:</strong> <span id="detail_updated_at"></span></p>
        </div>
        <div class="mt-4 text-right">
            <button onclick="closeDetail()"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Tutup</button>
        </div>
    </div>
</div>