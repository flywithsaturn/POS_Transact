<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list'  => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang tersedia dalam sistem'
        ];

        $activeMenu = 'kategori';

        return view('kategori.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
    
        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn  = '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
    
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list'  => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama'
        ]);

        KategoriModel::create($request->all());

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    public function show(string $id)
    {
        $kategori = KategoriModel::find($id);

        return view('kategori.show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama,' . $id . ',kategori_id'
        ]);

        $kategori = KategoriModel::find($id);
        $kategori->update($request->all());

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id)
    {
        $kategori = KategoriModel::find($id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
            KategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terkait dengan tabel lain');
        }
    }

    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = ['kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama'];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            KategoriModel::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data kategori berhasil disimpan']);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = ['kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama,' . $id . ',kategori_id'];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal.', 'msgField' => $validator->errors()]);
            }

            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
            }

            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);
            if ($kategori) {
                $kategori->delete();
                return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
            }
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return redirect('/');
    }
}
