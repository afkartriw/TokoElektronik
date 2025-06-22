<div id="modalProduk" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50" style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); background-color: rgba(0,0,0,0.2);">
    <div class="bg-white w-full max-w-md rounded-lg p-6 shadow">
        <h2 class="text-xl font-bold mb-4" id="modalTitle">Tambah Produk</h2>
        <form method="POST" id="formProduk">
            @csrf
            <input type="hidden" name="_method" id="formMethod">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" id="harga" class="w-full border px-3 py-2 rounded" required min="0">
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" id="stok" class="w-full border px-3 py-2 rounded" required min="0">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded">Batal</button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>