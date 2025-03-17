@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Barang</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('barang.update', $barang->barang_id) }}">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" class="form-control" name="barang_kode" value="{{ old('barang_kode', $barang->barang_kode) }}" required>
                @error('barang_kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="barang_nama" value="{{ old('barang_nama', $barang->barang_nama) }}" required>
                @error('barang_nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->kategori_id }}" {{ old('kategori_id', $barang->kategori_id) == $kat->kategori_id ? 'selected' : '' }}>
                            {{ $kat->kategori_nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" class="form-control" name="harga_beli" value="{{ old('harga_beli', $barang->harga_beli) }}" required>
                @error('harga_beli')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" class="form-control" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                @error('harga_jual')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
