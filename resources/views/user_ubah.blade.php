<!DOCTYPE html>
<html>
<head>
    <title>Ubah Data User</title>
</head>
<body>
    <h1>Form Ubah Data User</h1>
    
    <!-- Form untuk mengubah data user -->
    <form method="POST" action="{{ url('/user/ubah_simpan/' . $data->user_id) }}">
        {{ csrf_field() }} 
        {{ method_field('PUT') }}

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" value="{{ $data->username }}" required>
        <br>

        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama" value="{{ $data->nama }}" required>
        <br>

        <input type="password" name="password" placeholder="Masukkan Password Baru">
        <br>

        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan ID Level" value="{{ $data->level_id }}" required>
        <br>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ url('/user') }}">Kembali ke Data User</a>
</body>
</html>
