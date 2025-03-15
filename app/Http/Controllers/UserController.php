<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
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

           $data = [
            'level_id'=> 2,
            'username' => 'manager_tiga',
            'nama' => 'manager 3',
            'password' => Hash::make('12345'), 
        ];
        UserModel::create($data);

        $user = UserModel::all();
        return view('user',['data' => $user]);
    }
    }

