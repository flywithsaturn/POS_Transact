<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager12';

        $user->save();

         $user->wasChanged(); // true
         $user->wasChanged('username'); // true
         $user->wasChanged(['username', 'level_id']); // true
         $user->wasChanged('nama'); // false
         dd($user->wasChanged(['nama', 'username'])); // true
    }
}

 // Praktikum Jobsheet 3
        //    // tambah data user dengan Eloquent Model
        //    $validLevelId = \DB::table('m_level')->pluck('level_id')->first(); // Ambil level_id pertama yang tersedia
        //    $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => $validLevelId
        // ];
        // UserModel::insert($data); // tambahkan data ke tabel m_user
        // // akses userMOdel
        // $user = UserModel::all(); //ambil semua data dari table m_user
        // return view('user', ['data' => $user]);

        // Praktikum Jobsheet 3
        // $data = [
        //     'nama' => 'Pelanggan pertama',
        // ];
        // UserModel::where('username','customer-1')->update($data); 
        // $user = UserModel::all(); //ambil semua data dari table m_user
        // return view('user', ['data' => $user]);

        // Praktikum 1 Jobsheet 4
        //    $data = [
        //     'level_id'=> 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'manager 3',
        //     'password' => Hash::make('12345'), 
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user',['data' => $user]);

        //Praktikum Jobsheet 4
        //   $user = UserModel::where('level_id', 2)->count(); //untuk menghitung banyaknya data yang muncul dengan level id 2
      
        //Praktikum Jobsheet 4
        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ]
        //     );

        //Praktikum jobsheet 4
        // $user->username = 'manager56';

        // $user->isDirty(); // true
        // $user->isDirty('username'); // true
        // $user->isDirty('nama'); // false
        // $user->isDirty(['nama', 'username']); // true

        // $user->isClean(); // false
        // $user->isClean('username'); // false
        // $user->isClean('nama'); // true
        // $user->isClean(['nama', 'username']); // false

        // $user->save();

        // $user->isDirty(); // false
        // $user->isClean(); // true

        // dd($user->isDirty());

        // $user->save();