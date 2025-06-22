<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $sortBy;
    protected $sortDir;

    public function __construct($search, $sortBy, $sortDir)
    {
        $this->search = $search;
        $this->sortBy = $sortBy;
        $this->sortDir = $sortDir;
    }

    public function collection()
    {
        return Produk::when($this->search, fn($q) =>
            $q->where('nama', 'like', "%{$this->search}%")
              ->orWhere('deskripsi', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDir)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama' => $item->nama,
                    'Deskripsi' => $item->deskripsi,
                    'Harga' => 'Rp ' . number_format($item->harga, 0),
                    'Stok' => $item->stok,
                    'Dibuat' => $item->created_at->format('d/m/Y'),
                    'Diubah' => $item->updated_at->format('d/m/Y')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Deskripsi',
            'Harga',
            'Stok',
            'Dibuat',
            'Diubah'
        ];
    }
}