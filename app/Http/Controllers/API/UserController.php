<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    use PasswordValidationRules;
    //function login
    public function login(Request $request){
        try{
            $request->validate([
                'email'=> 'email|required',
                'password'=>'required'
            ]);

            $credentials = request(['email','password']);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message'=>'Unauthorized'
                ],'Authentication Failed',500);
            }
            //jika hash tidak sesuai
            $user = User::where('email',$request->email)->first();
            if(!Hash::check($request->password, $user->password,[])){
                throw new \Exception('invalid Credentials');

            }

            //jika login berhasil
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type'=>'Bearer',
                'user'=>$user
            ],'Authenticated');

        }catch(Exception $error){
            return ResponseFormatter::error([
                'message' => 'Login gagal',
                'error'=> $error
            ],'Authentication Failed',500);
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    // register
    public function register(Request $request){
        try{

            $request->validate([
                'name' => ['required','string','max:255'],
                'email'=>['required','string','email','max:255','unique:users'],
                'password'=> $this->passwordRules()

            ]);
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'role'=>$request->role,
                'owner'=>$request->owner,
                'city'=>$request->city,
                'contactNumber'=>$request->contactNumber
                 
            ]);

            $user = User::where('email',$request->email)->first();
            //ambil token
         
            $tokenResult = $user->createToken('authToken')->plainTextToken;
          
           
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ],'User Registered');

            
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    //logout

    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token,'Token Revoked');
    }

    //get user data
    public function fetch(Request $request){
        return ResponseFormatter::success(
            $request->user(),
            'Data Profile Berhasil diambil');
    }

    public function updatePhoto(Request $request){
        $validator =Validator::make($request->all(),[
            'file'=>'required|image|max:2048'
        ]);
        //cek validator
        if($validator->false()){
            ResponseFormatter::error(
                ['error'=> $validator->errors],
                'Update photo,fails',
                401

            );
        }
        //dont forget php artisan storage:link
        if($request->file('file')){
            $file = $request->file->store('assets/user','public');

            //simpan
            $user  = Auth::user();
            $user->img_brand = $file;
            $user->update();

            return ResponseFormatter::success([$file],'File successfully uploaded');
        }
    }
}
