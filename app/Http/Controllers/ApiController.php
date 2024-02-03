<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPengguna;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    public function dashboard(){
        try {
            $userCounts = MasterPengguna::selectRaw('COUNT(*) as total_users, CAST(SUM(CASE WHEN user_status = 1 THEN 1 ELSE 0 END) AS UNSIGNED) as active_users')
                         ->first();

            $data = [
                "user" => $userCounts->total_users,
                "user_active" => $userCounts->active_users
            ];

            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
       
    }

    public function list(){

        try {
            $data = MasterPengguna::orderby("user_fullname","ASC")->get();

            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
        
    }

    public function tambahPengguna(Request $request){

        try {
            MasterPengguna::create([
                "user_email" => $request->email,
                "user_fullname" => $request->fullname,
                "user_status" => 1,
                "password" => $request->password
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Success!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
        
    }

    public function edit($id){

        try {
            $data = MasterPengguna::where('user_id',$id)->first();
           
            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function editPost(Request $request, $id){

        try {
            $data = MasterPengguna::where('user_id',$id)->first();
            $data->update([
                "user_email" => $request->email,
                "user_fullname" => $request->fullname,
                "user_status" => 1,
                "password" => $request->password
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
        
    }

    public function delete($id){

        try {
            $data = MasterPengguna::find($id)->delete();
           
            return response()->json([
                "status" => 200,
                "message" => "Success!",
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => 400,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('AuthToken')->plainTextToken;
            $url = route('dashboard');
            return response()->json(['token' => $token, 'url' => $url], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }
}
