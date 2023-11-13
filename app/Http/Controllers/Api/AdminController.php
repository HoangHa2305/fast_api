<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $login = [
            'email' => $email,
            'password' => $password
        ];
        if(Auth::attempt($login)){
            return response()->json(['success'=>'Đăng nhập thành công']);
        }else{
            return response()->json(['errors'=>'Đăng nhập thất bại']);
        }
    }

    public function getaccountTutor()
    {
        $tutor = Tutor::where('active',0)->get();
        if($tutor){
            return response()->json(['tutor'=>$tutor]);
        }
    }

    public function acceptTutor(string $id)
    {
        $tutor = Tutor::findOrFail($id);
        $tutor->active = 1;
        if($tutor->save()){
            $result = Tutor::where('active',0)->get();
            return response()->json(['tutor'=>$result]);
        }
    }

    public function getBlog()
    {
        $blog = Blog::where('active',0)->get();
        if($blog){
            return response()->json(['blog'=>$blog]);
        }
    }

    public function acceptBlog(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->active = 1;
        if($blog->save()){
            $result = Blog::where('active',0)->get();
            return response()->json(['blog'=>$result]);
        }
    }
}
