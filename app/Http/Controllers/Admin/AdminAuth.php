<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use  Validator;
use Redirect;
use Symfony\Component\HttpFoundation\Cookie;
class AdminAuth extends Controller
{
    public function login(){
    
        if( Request()->cookie('remember-me')==1){
            return  redirect(admin_url('home'));
        }else{
            return view('admin.login');
        }
        
    }
    public function doLogin(Request $request){
        $rule = [
            'mobile'=>'required',
            'password'=>'required|min:8|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#@%]).*$/'
          ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
            return redirect(admin_url('/'))->withErrors($validator);
            }
            

        $res= Http::post('https://api-task1.adminssw.com/users/trainerLogin', [
            'countryCodeName' => strtoupper($request->country_name),
            'countryCode' => '+'.$request->country_code,
            'userPhone'=>$request->mobile,
            'userPassword'=>$request->password
        ]);
        if(json_decode($res->body())->status==1){
            if($request->remember_me=='on'){
                $minutes = 60;
                $cookie = cookie('remember-me', 1, $minutes);
              return  redirect(admin_url('home'))->cookie($cookie);
           }
        }else{
            return view('admin/login')->with('error_msg',json_decode($res->body())->msg);
        }

    }
    public function logout(){
        admin()->logout();
        return redirect(admin_url('/'));

    }
}
