@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->barang_kode }}</td>
                    <td>{{ $item->barang_nama }}</td>
                    <td>{{ $item->kategori->kategori_nama ?? '-' }}</td>
                    <td>Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ url('barang/' . $item->barang_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ url('barang/' . $item->barang_id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ url('barang/' . $item->barang_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
