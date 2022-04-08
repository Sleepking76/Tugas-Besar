<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function index(){
        return view('user.register');
    }

    public function store(Request $request){
       $validatedData = $request->validate([
            'nama' => 'required|max:255|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:20'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        User::create($validatedData);

        // $request->session()->flash('status','Registrasi Berhasil! Anda Sudah Dapat Login :))');
        
        return redirect('/')->with('status','Registrasi Berhasil! Anda Sudah Dapat Login');
    }
}
