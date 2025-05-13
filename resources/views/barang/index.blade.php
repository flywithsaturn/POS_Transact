@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card">
            <div class="card-header">a
                <h3 class="card-title">Daftar Barang</h3>
                <div class="card-tools">
                    <button onclick="modalAction('{{ url('/barang/import') }}')" class="btn btn-info">Import Barang</button>
                    <a href="{{ url('/barang/create') }}" class="btn btn-primary">Tambah Data</a>
                    <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-success">Tambah Data
                        (Ajax)</button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
            data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

    @push('css')
    @endpush

    @push('js')
        <script>
            function modalAction(url = '') {
                $('#myModal').load(url, function () {
                    $('#myModal').modal('show');
                });
            }

            var dataBarang;
            $(document).ready(function () {
                dataBarang = $('#table_barang').DataTable({
                    serverSide: true,
                    ajax: {
                        url: "{{ url('barang/list') }}",
                        dataType: "json",
                        type: "POST"
                    },
                    columns: [
                        {
                            data: "DT_RowIndex",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: "barang_kode",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "barang_nama",
                            className: "",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "harga_beli",
                            className: "text-center",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "harga_jual",
                            className: "text-center",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "kategori",
                            className: "text-center",
                            orderable: true,
                            searchable: true
                        },
                        {
                            data: "aksi",
                            className: "text-center",
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            });
        </script>
    @endpush