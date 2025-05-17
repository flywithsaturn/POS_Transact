<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang tersedia dalam sistem'
        ];

        $activeMenu = 'level';

        return view('level.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama'); // Pastikan level_kode ada di sini

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $level->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_nama' => 'required|string|min:3|unique:m_level,level_nama'
        ]);

        LevelModel::create($request->all());

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';

        return view('level.edit', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_nama' => 'required|string|min:3|unique:m_level,level_nama,' . $id . ',level_id'
        ]);

        $level = LevelModel::find($id);
        $level->update($request->all());

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = ['level_nama' => 'required|string|min:3|unique:m_level,level_nama'];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            LevelModel::create($request->all());
            return response()->json(['status' => true, 'message' => 'Data level berhasil disimpan']);
        }

        return redirect('/');
    }
    public function show_ajax(string $id)
    {
        // Menambahkan eager loading pada relasi kategori
        $level = LevelModel::find($id);
        return view('level.show_ajax', compact('level'));
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = ['level_nama' => 'required|string|min:3|unique:m_level,level_nama,' . $id . ',level_id'];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi gagal.', 'msgField' => $validator->errors()]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update($request->all());
                return response()->json(['status' => true, 'message' => 'Data berhasil diupdate']);
            }

            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();
                return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
            }
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return redirect('/');
    }
    public function import()
    {
        return view('level.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_level' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_level');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true); // kolom pakai huruf (A, B, C, dst)

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        // Cek apakah kolom A dan B tersedia dan tidak kosong
                        if (!empty($value['A']) && !empty($value['B'])) {
                            $insert[] = [
                                'level_kode' => $value['A'],
                                'level_nama' => $value['B'],
                                'created_at' => now(),
                            ];
                        }
                    }
                }

                if (count($insert) > 0) {
                    LevelModel::insertOrIgnore($insert);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data level berhasil diimport'
                    ]);
                }

                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data level yang valid untuk diimport'
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'File kosong atau tidak sesuai format'
            ]);
        }

        return redirect('/');
    }

    public function export_excel()
    {
        // Get level data to export
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama')
            ->orderBy('level_id')
            ->get();

        // Load Excel library
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Level');
        $sheet->setCellValue('C1', 'Nama Level');
        $sheet->setCellValue('D1', 'ID Level');

        // Make headers bold
        $sheet->getStyle('A1:D1')->getFont()->setBold(true);

        // Populate data
        $no = 1;
        $row = 2;
        foreach ($levels as $level) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $level->level_kode);
            $sheet->setCellValue('C' . $row, $level->level_nama);
            $sheet->setCellValue('D' . $row, $level->level_id);
            $row++;
            $no++;
        }

        // Auto-size columns
        foreach (range('A', 'D') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Set sheet title
        $sheet->setTitle('Data Level');

        // Create writer and set headers for download
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Level ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama')
            ->orderBy('level_id')
            ->get();

        $pdf = Pdf::loadView('level.export_pdf', ['levels' => $levels]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption("isRemoteEnabled", true);
        $pdf->render();
        return $pdf->stream('Data Level ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
