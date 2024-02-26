<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $req){

        $user = User::create($req->validated());

        return new AuthResource($req);
    }

    public function login(AuthRequest $req){

        $user = User::where('email',$req->email)->first();

        if(!$user || !Hash::check($req->password,$user->password))
        return response()->json(['message'=>'الرجاء ادخال ايميل او كلمة مرور صحيحين'],422);

        $user->tokens()->delete();

        $token = $user->createToken('API TOKEN')->plainTextToken;

        return response()->json(['message'=>'تم تسجيل الدخول.','token'=>$token]);
    }
}
