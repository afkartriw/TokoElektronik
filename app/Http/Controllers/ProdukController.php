<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ProdukController extends Controller
{
   public function index(Request $request)
    {
        $search = $request->search;
        $sortBy = $request->sortBy ?? 'created_at';
        $sortDir = $request->sortDir ?? 'desc';
        $perPage = $request->perPage ?? 10;

        $produks = Produk::when($search, fn($q) =>
            $q->where('nama', 'like', "%$search%")
            ->orWhere('deskripsi', 'like', "%$search%"))
            ->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->withQueryString();

        return view('produk.index', compact('produks', 'search', 'sortBy', 'sortDir', 'perPage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create($validated);
        return redirect('/')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::findOrFail($id)->update($validated);
        return redirect('/')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Produk berhasil dihapus');
    }

    public function exportPdf()
    {
        $search = request('search');
        $sortBy = request('sortBy', 'created_at');
        $sortDir = request('sortDir', 'desc');
        
        $data = Produk::when($search, fn($q) =>
            $q->where('nama', 'like', "%$search%")
            ->orWhere('deskripsi', 'like', "%$search%"))
            ->orderBy($sortBy, $sortDir)
            ->get();

        $pdf = Pdf::loadView('produk.export-pdf', compact('data'));
        return $pdf->download('produk-'.now()->format('Ymd-His').'.pdf');
    }

    public function exportXlsx()
    {
        $search = request('search');
        $sortBy = request('sortBy', 'created_at');
        $sortDir = request('sortDir', 'desc');
        
        return Excel::download(
            new ProdukExport(
                $search,
                $sortBy,
                $sortDir
            ), 
            'produk-'.now()->format('Ymd-His').'.xlsx'
        );
    }
}
