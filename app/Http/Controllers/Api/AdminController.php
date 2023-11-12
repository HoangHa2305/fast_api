<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->json()->all();

        $login = [
            'email' => $data['email'],
            'password' => $data['password']
        ];
        if(Auth::attempt($login)){
            return response()->json(['success'=>'Đăng nhập thành công']);
        }else{
            return response()->json(['errors'=>'Đăng nhập thất bại']);
        }
    }
}
