<form action="{{ url('/barang/ajax') }}" method="POST" id="form-tambah-barang">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="barang_kode">Kode Barang</label>
                    <input type="text" name="barang_kode" id="barang_kode" class="form-control" required>
                    <small id="error-barang_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="barang_nama">Nama Barang</label>
                    <input type="text" name="barang_nama" id="barang_nama" class="form-control" required>
                    <small id="error-barang_nama" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->kategori_id }}">{{ $kat->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control" required min="1">
                    <small id="error-harga_beli" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control" required min="1">
                    <small id="error-harga_jual" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#form-tambah-barang").validate({
            rules: {
                barang_kode: { required: true, maxlength: 10 },
                barang_nama: { required: true, maxlength: 100 },
                kategori_id: { required: true },
                harga_beli: { required: true, number: true, min: 1 },
                harga_jual: { required: true, number: true, min: 1 }
            },
            messages: {
                barang_kode: {
                    required: "Kode barang tidak boleh kosong",
                    maxlength: "Kode barang maksimal 10 karakter"
                },
                barang_nama: {
                    required: "Nama barang tidak boleh kosong",
                    maxlength: "Nama barang maksimal 100 karakter"
                },
                kategori_id: {
                    required: "Kategori harus dipilih"
                },
                harga_beli: {
                    required: "Harga beli tidak boleh kosong",
                    number: "Harga beli harus berupa angka",
                    min: "Harga beli harus lebih besar dari 0"
                },
                harga_jual: {
                    required: "Harga jual tidak boleh kosong",
                    number: "Harga jual harus berupa angka",
                    min: "Harga jual harus lebih besar dari 0"
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataBarang.ajax.reload(); // Pastikan dataBarang adalah objek DataTable
                        } else {
                            $('.error-text').text(''); // Reset errors
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]); // Show errors on form fields
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Tidak dapat mengirim data.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>