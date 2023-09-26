<?php

namespace App\Http\Controllers;

use App\Models\banquetRegister;
use App\Models\details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class upload_details extends Controller
{
    public function detail() {
        $details = DB::table('details')
                       ->select('details.*','images.image','dates.date')
                       ->leftJoin('images','images.id','details.fk_images_id')
                       ->leftJoin('dates','dates.id','details.fk_dates_id')
                       ->get();

        return view('details',['details' => $details]);
    }
    public function details() {
        $details = array();
        if(Session::has('loginEmail')) {
            $details = banquetRegister::where('email','=',Session::get('loginEmail'))->first();

        }
        return view('details',compact('data')); 
                    
    }


    public function updateDetails(Request $request) {
        $request->validate([
            'banquetname' => 'required',
            'registrationNumber' => 'required',
            'location' => 'required',
            'licenseNumber' => 'required',
            'contactNumber' => 'required',
        ]);

  
    
        $temp3= banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        // $temp2= banquetRegister::where('email','=',Session::get('loginEmail'));

        if($temp3)
        {
            $temp3->banquetname = $request->banquetname;
            $temp3->registrationNumber = $request->registrationNumber;
            $temp3->location = $request->location;
            $temp3->licenseNumber = $request->licenseNumber;
            $temp3->contactNumber = $request->contactNumber;
            $temp3->email = $request->email;
            // if($request->filled('password')) {
            //     $request->validate([
            //         'password'=> 'min:8|confirmed',
            //     ]);
            //     $temp3->password = Hash::make($request->password);
            //     // $temp1->update();
            // }
            if($request->filled('capacity')) {
                $request->validate([
                    'capacity' => 'required',
                ]);
                $temp3->capacity = $request->capacity;
                // $temp1->update();
            }
            if($request->hasFile('image[]')) {
                // $image_path = "/profile_pictures/$temp1->profile";
                // if(File::exists($image_path)){
                //     File::delete($image_path);
                // }
                $request->validate([
                    'image'=> 'image|mimes:png,jpeg,jpg,svg,gif|max:5048',
                ]);
                $imagename = time(). "-" . $request->banquetname . "." .$request->image->extension();
                $request->profile->move(public_path('banquet_pictures'),$imagename);
                $temp3->profile = $imagename;
                // $temp1->update();
            }
            $temp3->update();


                return back()->with('success','You have updated successfully');
        }else{
                return back()->with('fail','Something went wrong');
            }
        }
   
}
