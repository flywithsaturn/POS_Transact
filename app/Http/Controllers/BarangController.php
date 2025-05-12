<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang tersedia dalam sistem'
        ];

        $activeMenu = 'barang';

        return view('barang.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $barang = BarangModel::with('kategori')->select('barang_id', 'barang_kode', 'barang_nama', 'kategori_id', 'harga_beli', 'harga_jual');

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('kategori', fn($row) => $row->kategori->kategori_nama ?? '-')
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $row->barang_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $row->barang_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/barang/' . $row->barang_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang baru'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.create', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
        ]);

        BarangModel::create($request->all());

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show', compact('breadcrumb', 'page', 'barang', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $barang = BarangModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit barang'
        ];

        $activeMenu = 'barang';
        $kategori = KategoriModel::all();

        return view('barang.edit', compact('breadcrumb', 'page', 'barang', 'activeMenu', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama' => 'required|string|max:100',
            'kategori_id' => 'required|exists:m_kategori,kategori_id',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
        ]);

        $barang = BarangModel::find($id);
        $barang->update($request->all());

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data gagal dihapus karena masih terhubung dengan data lain');
        }
    }

    // ==================== AJAX ====================

    public function create_ajax()
    {
        $kategori = KategoriModel::all();
        return view('barang.create_ajax', compact('kategori'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:m_kategori,kategori_id',
                'harga_beli' => 'required|integer|min:0',
                'harga_jual' => 'required|integer|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            BarangModel::create($request->all());

            return response()->json(['status' => true, 'message' => 'Data barang berhasil disimpan']);
        }

        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);
        return view('barang.show_ajax', compact('barang'));
    }

    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        return view('barang.edit_ajax', compact('barang', 'kategori'));
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:m_kategori,kategori_id',
                'harga_beli' => 'required|integer|min:0',
                'harga_jual' => 'required|integer|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal', 'msgField' => $validator->errors()]);
            }

            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data berhasil diperbarui']);
            }

            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', compact('barang'));
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->delete();
                return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
            }

            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return redirect('/');
    }
}
