@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Kategori</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('kategori.update', $kategori->kategori_id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Kategori</label>
                <input type="text" class="form-control" name="kategori_kode" value="{{ old('kategori_kode', $kategori->kategori_kode) }}" required>
                @error('kategori_kode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control" name="kategori_nama" value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
                @error('kategori_nama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
</div>
@endsection
