<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { margin-top: 20px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Data Produk</h2>
        @if(request('search'))
            <p>Hasil pencarian: "{{ request('search') }}"</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Dibuat</th>
                <th>Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $produk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->deskripsi }}</td>
                <td>Rp {{ number_format($produk->harga, 0) }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ $produk->created_at->format('d/m/Y') }}</td>
                <td>{{ $produk->updated_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>