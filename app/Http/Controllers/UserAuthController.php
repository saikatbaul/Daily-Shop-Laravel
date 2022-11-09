<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Cart;
use Socialite;
use Exception;
use Auth;

class UserAuthController extends Controller
{


    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook(Request $request)
    {
        try {
    
            $user = Socialite::driver('facebook')->stateless()->user();
            $isUser = User::where('userName', $user->id)
                    ->orWhere('email', $user->email)
                    ->first();
            
            $userName=(string)$user->id;
            if($isUser){
                //return "sds";
                $request->session()->put('LoggedUser', $user->name);
                $request->session()->put('userType', 'Customer');
                $request->session()->put('userNames', $userName);
                session()->put('cart', Cart::where('userName', session()->get('userNames'))->count());
                if(session()->has('idd')){
                    return redirect()->route('ProductDetail' ,['id' => session()->get('idd'), 'userId' => session()->get('LoggedUser') ]);
                }
                return redirect()->route('index');
            }else{
                $userNamebb= $user->name;
                $user = User::create([
                    'userName' => $userName,
                    'email' => $user->email,
                    'userType' => 'Customer',
                    'password'=> Hash::make('1111'),
                ]);
                $customer = Customer::create([
                    'userName' => $userName,
                    'email' => $user->email,
                    'userType' => 'Customer',
                ]);
                $request->session()->put('userType', 'Customer');
                $request->session()->put('LoggedUser', $userNamebb);
                $request->session()->put('userNames', $userName);
                if(session()->has('idd')){
                    return redirect()->route('ProductDetail' ,['id' => session()->get('idd'), 'userId' => session()->get('LoggedUser') ]);
                }
                return redirect()->route('index');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }



    public function googleRedirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(Request $request)
    {
        try {
    
            $user = Socialite::driver('google')->stateless()->user();
            //return $user->name;
            $isUser = User::where('userName', $user->id)
                    ->orWhere('email', $user->email)
                    ->first();

            $userName=(string)$user->id;
            if($isUser){
                //return "sds";
                $request->session()->put('LoggedUser', $user->name);
                $request->session()->put('userType', 'Customer');
                $request->session()->put('userNames', $userName);
                if(session()->has('idd')){
                    return redirect()->route('ProductDetail' ,['id' => session()->get('idd'), 'userId' => session()->get('LoggedUser') ]);
                }
                return redirect()->route('index');
            }else{
                $userNamebb= $user->name;
                $user = User::create([
                    'userName' => $userName,
                    'email' => $user->email,
                    'userType' => 'Customer',
                    'password'=> Hash::make('1111'),
                ]);
                $customer = Customer::create([
                    'userName' => $userName,
                    'email' => $user->email,
                    'userType' => 'Customer',
                ]);
                $request->session()->put('userType', 'Customer');
                $request->session()->put('LoggedUser', $userNamebb);
                $request->session()->put('userNames', $userName);
                if(session()->has('idd')){
                    return redirect()->route('ProductDetail' ,['id' => session()->get('idd'), 'userId' => session()->get('LoggedUser') ]);
                }
                return redirect()->route('index');
            }
    
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


    
    function register(){
        return view('auth.register');
    }

    function registered(Request $request){

        $request->validate([
            'userName'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>[
                'required',
                'string',
                'min:4',
                'max:20'             
            ],
            'phone'=>[
                'required',
                'regex:/[0-9]/',
                'string',
                'min:11',
                'max:11'             
            ],
            'DOB'=>'required|string',
            'gender'=>'required|string',
            'address'=>'required|string',
        ],

        [
            'DOB.required' => "The date of birth field is required",
            'DOB.string' => "The date of birth field must be string",
            'cPassword.required' => 'The confirm password field is required.',
            'cPassword.string' => 'The confirm password field must be string.',
            'cPassword.min' => 'The confirm password field must be at least 5 characters.',
            'cPassword.dmax' => 'The confirm password must not be greater than 20 characters.',
        ]
    );

        $user=new User;

        $user->userName=$request->userName;
        $user->email=$request->email;
        $user->userType="Customer";
        $user->password=Hash::make($request->password);

        $userQuery = $user->save();

        $customer=new Customer;

        $customer->userName=$request->userName;
        $customer->email=$request->email;
        $customer->phone=$request->phone;
        $customer->DOB=$request->DOB;
        $customer->gender=$request->gender;
        $customer->address=$request->address;
        $customer->district=$request->district;
        $customer->userType="Customer";

        $customerQuery = $customer->save();

        $request->session()->put('LoggedUser', $user->userName);

        if($customerQuery && $userQuery){
            return redirect()->route("index");
        }else{
            return back()->with('fail','Something went wrong');
        }
    }

    function login(){
        return view('auth.login');
    }

    function check(Request $request){
    
        $idd=$request->idd;
        $ids=$request->ids;
        //return $request;
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('userName', '=', $request->user)
                    ->orWhere('email', '=', $request->user)
                    ->first();

        if($user){
            if($user->userType=='Admin'){
                $userbytype= Admin::where('userName', '=', $request->user)
                    ->orWhere('email', '=', $request->user)
                    ->first();
            }
            if(Hash::check($request->password, $user->password)){
                //return $user->userType;
                if($user->userType=="Admin"){
                    $request->session()->put('LoggedUser', $user->userName);
                    $request->session()->put('name', $userbytype->name);
                    $request->session()->put('email', $user->email);
                    $request->session()->put('userType', $user->userType);
                    $request->session()->put('picture', $userbytype->picture);
                    return redirect()->route('Home');
                }else if($user->userType=="Customer"){
                    $request->session()->put('LoggedUser', $user->userName);
                    if($idd){
                        return redirect()->route('ProductDetail' ,['id' => $ids, 'userId' => session()->get('LoggedUser') ]);
                    }else{
                        return redirect()->route('index');
                    }
                }else{
                    return back()->with('fail', 'Invalid request');
                }
            }else{
                $request->session()->flash('user', $request->user);
                return back()->with('fail', 'Invalid password');
            }
        }else{
            return back()->with('fail', 'No account found for this email or username');
        }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->flush();
            return redirect()->route("index");
        }
    }

}
