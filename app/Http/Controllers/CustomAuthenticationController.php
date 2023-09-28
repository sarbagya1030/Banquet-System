<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\banquetRegister;
use App\Models\capacity;
use App\Models\dates;
use App\Models\images;
use App\Models\menu;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class CustomAuthenticationController extends Controller
{
    public function login() {
        return view ("auth.login");
    }

    public function registration () {
        return view("auth.registration");
    }

    public function banquetRegister () {
        return view("auth.registrationOwner");
    }

    
    public function registerUser(Request $request) {
    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'password'=> 'required|min:8|confirmed',
        // 'password_confirmation' => 'required|min:8'
    ]);

    if(User::where('email','=',$request->email)->first() || banquetRegister::where('email','=',$request->email)->first()) {
        return back()->with('fail','Email already taken');
    }
    else {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->confirm_password = $request->password_confirmation;
        $res = $user->save();
        if($res) {
            return back()->with('success','You have registered successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
        
    }
    }

    public function registerOwner(Request $request) {
        $request->validate([
            'banquetname' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'registrationNumber' => 'required',
            'licenseNumber' => 'required',
            'contactNumber' => 'required',
            'description' => 'required',
            'password'=> 'required|min:8|confirmed',
            // 'password_confirmation' => 'required|min:8'
        ]);

        if(User::where('email','=',$request->email)->first() || banquetRegister::where('email','=',$request->email)->first()) {
            return back()->with('fail','Email already taken');
        }
        else {
        $banquet_registers = new banquetRegister();
        $banquet_registers->banquetname = $request->banquetname;
        $banquet_registers->email = $request->input('email');
        $banquet_registers->location = $request->location;
        $banquet_registers->registrationNumber = $request->registrationNumber;
        $banquet_registers->licenseNumber = $request->licenseNumber;
        $banquet_registers->contactNumber = $request->input('contactNumber');
        $banquet_registers->description = $request->description;
        $banquet_registers->password = Hash::make($request->password);
        // $user->confirm_password = $request->password_confirmation;
        $res = $banquet_registers->save();
        if($res) {
            return back()->with('success','You have registered successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
        }
    }


    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);

        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)) {
                $request->session()->put('loginEmail',$user->email);
                return redirect('dashboard');
            } else {
                return back()->with('fail','Password doesnot match');
            }

        } else{
            $banquet = banquetRegister::where('email','=',$request->email)->first();
            if($banquet){
                if(Hash::check($request->password,$banquet->password)) {
                    $request->session()->put('loginEmail',$banquet->email);
                    $data = array();
                    if(Session::has('loginEmail')) {
                        $data = banquetRegister::where('email','=',Session::get('loginEmail'))->first();
                    }
                    return redirect('dashboardOwner');    
                } else {
                    return back()->with('fail','Password doesnot match');
                }
            }
            else{
                return back()->with('fail','This email is not registered');
            }
                
            }
    }


    public function logout() {
        if(Session::has('loginEmail')) {
            Session::pull('loginEmail');
            return redirect('login');
        }
    }

    public function profile() {
        $data = array();
        if(Session::has('loginEmail')) {
            $data = User::where('email','=',Session::get('loginEmail'))->first();

        }
        return view('profile',compact('data')); 
                    
    }

    public function dash() {
        $data = array();
        $Users = array();
        $Banquet = banquetRegister::all();

        if(Session::has('loginEmail')) {
            $data = User::where('email','=',Session::get('loginEmail'))->first();

        }
        return view('dashboard',compact('data','Banquet'));    
    }

    public function dashOwner() {

        $data = array();
        $dinner = null;
        $snacks = null;
        $dessert = null;
        $data = banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        $capacity = capacity::where('fk_banquet_id','=',$data->id)->first();

        $datesCheck = dates::where('fk_banquet_id','=',$data->id)->first();
        $imageCheck = images::where('fk_banquet_id','=',$data->id)->first();
        $menuCheck = menu::where('fk_banquet_id','=',$data->id)->first();
        $dates = dates::where('fk_banquet_id','=',$data->id)->get();
        $image = images::where('fk_banquet_id','=',$data->id)->get();
        $menu = menu::where('fk_banquet_id','=',$data->id)->get();

        foreach ($menu as $m) {
            if ($m->type == 'dinner') {
                $dinner = 1;
                break;
            }
        }
   
        foreach ($menu as $m) {
            if ($m->type == 'snacks') {
                $snacks = 1;
                break;
            }
        }

        foreach ($menu as $m) {
            if ($m->type == 'dessert') {
                $dessert = 1;
                break;
            }
        }


        if($datesCheck == null)
        {
            $dates = null;
        }
        if($imageCheck == null)
        {
            $image = null;
        }
        if($menuCheck == null){
            $menu = null;
        }

        return view('dashboardOwner',compact('data','image','menu','dates','capacity','dinner','snacks','dessert'));    
    }

    public function updateProfileUser(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
        ]);

  
    
        $temp1= User::where('email','=',Session::get('loginEmail'))->first();
        // $temp2= banquetRegister::where('email','=',Session::get('loginEmail'));

        if($temp1)
        {
            $temp1->firstname = $request->firstname;
            $temp1->email = $request->email;
            $temp1->lastname = $request->lastname;
            if($request->filled('password')) {
                $request->validate([
                    'password'=> 'min:8|confirmed',
                ]);
                $temp1->password = Hash::make($request->password);
                // $temp1->update();
            }
            if($request->filled('bio')) {
                $request->validate([
                    'bio' => 'max:100|string',
                ]);
                $temp1->bio = $request->bio;
                // $temp1->update();
            }
            if($request->hasFile('profile')) {
                // $image_path = "/profile_pictures/$temp1->profile";
                // if(File::exists($image_path)){
                //     File::delete($image_path);
                // }
                $request->validate([
                    'profile'=> 'image|mimes:png,jpeg,jpg,svg,gif|max:5048',
                ]);
                $imagename = time(). "-" . $request->firstname . "." .$request->profile->extension();
                $request->profile->move(public_path('profile_pictures'),$imagename);
                $temp1->profile = $imagename;
                // $temp1->update();
            }
            $temp1->update();


                return back()->with('success','You have updated successfully');
        }else{
                return back()->with('fail','Something went wrong');
            }
        }
    }