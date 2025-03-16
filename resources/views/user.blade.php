<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="{{ url('/user/tambah') }}" class="btn btn-success">+ Tambah User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <td>Kode Level</td>
            <td>Nama Level</td>
            <th>Aksi</th>
        </tr>

        @if(count($data) > 0)
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->level_id }}</td>
                <td>{{ $d->level->level_kode }}</td>
                <td>{{ $d->level->level_nama }}</td>
                <td>
                    <a href="{{ url('/user/ubah/' . $d->user_id) }}">Ubah</a> |
                    <a href="{{ url('/user/hapus/' . $d->user_id) }}" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>          
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data pengguna.</td>
            </tr>
        @endif
    </table>
</body>
</html>
