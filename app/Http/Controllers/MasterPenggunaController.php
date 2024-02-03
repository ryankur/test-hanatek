<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterPenggunaController extends Controller
{   
    public function dashboardPages() {
        return view('dashboard');
    }

    public function masterPenggunaPages(){

        return view('master_pengguna');
    }

    public function tambahPenggunaPages(){
        return view('tambah');
    }

    public function editPenggunaPages($id){

        return view('edit');
    }

    public function logout(){

    }
}
