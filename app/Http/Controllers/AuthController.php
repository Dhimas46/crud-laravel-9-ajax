<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
      return view('auth.login');
    }
    public function registerView()
    {
      return view('auth.register');
    }

    

    public function register(Request $request)
      {
          $validator = Validator::make($request->all(), [
              'name' => 'required|max:255',
              'email' => 'required|email|unique:users,email',
              'password' => 'required|min:8|max:255',
              'password_confirmation' => 'required|same:password',
          ]);

          if ($validator->fails()) {
              $errors = $validator->errors();
              return response()->json([
                  'message' => $errors->first(),
              ], 422);
          }

          $name = $request->input('name');
          $email = $request->input('email');
          $password = $request->input('password');

          // Hash password sebelum disimpan ke database
          $hashedPassword = Hash::make($password);
          $user = new User();
          $user->name = $name;
          $user->email = $email;
          $user->password = $hashedPassword;
          $user->save();

          return response()->json([
              'success' => true,
              'message' => 'Registrasi berhasil',
          ], 200);
      }

  public function login(Request $request)
     {
         $email = $request->input('email');
         $password = $request->input('password');

         $credentials = [
             'email' => $email,
             'password' => $password,
         ];

         if (Auth::attempt($credentials)) {
             // Jika autentikasi berhasil, kirim respon dengan status 200 OK
              $user = Auth::user();
              $token = $user->createToken('token')->plainTextToken;
              return response()->json([
                 'message' => 'Login berhasil',
                 'user' => $user,
                 'token' => $token
             ], 200);
           } else {
               // Jika autentikasi gagal, coba lagi dengan mengubah password menjadi terbcrypt
               $user = User::where('email', $email)->first();
               if ($user && \Hash::check($password, $user->password)) {
                   Auth::login($user);
                   return response()->json([
                       'message' => 'Login berhasil'
                   ], 200);
               } else {
                   // Jika autentikasi gagal lagi, kirim respon dengan status 401 Unauthorized
                   return response()->json([
                       'message' => 'Email atau password salah'
                   ], 401);
               }
           }
       }

       public function logout(Request $request)
        {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out']);
        }


}
