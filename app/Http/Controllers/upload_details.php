<?php

namespace App\Http\Controllers;
use App\Models\banquetRegister;
use App\Models\capacity;
use App\Models\dates;
use App\Models\menu;
use App\Models\images;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class upload_details extends Controller
{

    //food update
    public function menus(Request $request,$email) {
        $request->validate([
            'item_name' => 'required|string',
            'type' => 'required',
            'price' => 'required',
        ]);

        $row = banquetRegister::where('email','=',$email)->first();
        $menus = new menu();
        $menus->foodname = $request->item_name;
        $menus->type = $request->type;
        $menus->price = $request->price;
        $menus->fk_banquet_id = $row->id;

        $res = $menus->save();
        if($res) {
            return back()->with('success','You have added item successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
        
    }

    //Available dates
    public function dates(Request $request,$email) {
        $request->validate([
            'dates' => 'required',
        ]);

        $row = banquetRegister::where('email','=',$email)->first();
        $dates = new dates();
        $dates->date = $request->dates;
        $dates->fk_banquet_id = $row->id;

        $res = $dates->save();
        if($res) {
            return back()->with('success','You have added date successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
        
    }

    //images
    public function images(Request $request,$email) {
        $request->validate([
            'images' => 'required|mimes:png,jpg,jpeg,svg,gif|image',
        ]);

        $row = banquetRegister::where('email','=',$email)->first();
        $picture = new images();
        $picture->fk_banquet_id = $row->id;
        $image_name = time() . "-" . $row->banquetname . "-" . $request->images->extension();
        $request->images->move(public_path('banquet'),$image_name);
        $picture->path = $image_name;

        $res = $picture->save();
        if($res) {
            return back()->with('success','You have added date successfully');
        }else{
            return back()->with('fail','Something went wrong');
        }
        
    }
    

     //capacity update
     public function capacities(Request $request,$email) {
        $request->validate([
            'banquet_capacity' => 'required',
            'two_wheeler_capacity' => 'required',
            'four_wheeler_capacity' => 'required',
        ]);

        $row = banquetRegister::where('email','=',$email)->first();
        $existingBanquet = capacity::where('fk_banquet_id','=',$row->id)->first();

        if($existingBanquet) {
            return back()->with('fail','Capacity already added');
        }
        else {

            $row = banquetRegister::where('email','=',$email)->first();
            $capacities = new capacity();
            $capacities->banquet_capacity = $request->banquet_capacity;
            $capacities->twowheeler = $request->two_wheeler_capacity;
            $capacities->fourwheeler = $request->four_wheeler_capacity;
            $capacities->fk_banquet_id = $row->id;

            $res = $capacities->save();
            if($res) {
            return back()->with('success','You have added capacity details successfully');
            }else{
            return back()->with('fail','Something went wrong');
            }
        }
        
    }

    public function recordupdate() {
        return view ("recordupdate");
    }

    public function viewprofileOwner() {
        $value= banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        return view ("profileOwner",compact('value'));  
    }



    public function profileUpdateOwner(Request $request) {
        $request->validate([
            'banquetname' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'registrationNumber' => 'required',
            'licenseNumber' => 'required',
            'contactNumber' => 'required',
            'description' => '',   
        ]);

        $value= banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        
        if($value) 
        {
            $value->banquetname = $request->banquetname;
            $value->email = $request->email;
            $value->location = $request->location;
            $value->registrationNumber = $request->registrationNumber;
            $value->licenseNumber = $request->licenseNumber;
            $value->contactNumber = $request->contactNumber;
            $value->description = $request->description;

            if($request->filled('password')) {
                $request->validate([
                    'password'=> 'min:8|confirmed',
                ]);
                $value->password = Hash::make($request->password);
        }
        $value->update();
        return back()->with('success','You have updated profile successfully');
    }else {
        return back()->with('fail','Something went wrong');
    }
    }

    public function deleteuserProfile($email) {
        $delete = User::where('email','=',$email)->first();
        $delete->delete();

            Session::pull('loginEmail');

        
        return redirect()->to(route('login'))->with('success','Account has been successfully deleted');
    }

    public function dateView(Request $request) {
        $row = banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        $select= dates::where('fk_banquet_id','=',$row->id)->get();

        return view('date',compact('select'));
    }

    public function menuView(Request $request) {
        $row = banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        $select= menu::where('fk_banquet_id','=',$row->id)->get();

        return view('menu',compact('select'));
    }

    public function capacityView(Request $request) {
        $row = banquetRegister::where('email','=',Session::get('loginEmail'))->first();
        $select= capacity::where('fk_banquet_id','=',$row->id)->get();

        return view('capacity',compact('select'));
    }

    public function deleteImages($id) {
        $delete= images::where('id','=',$id)->first();
        $delete->delete();

        $image_path = public_path("banquet/{$delete->path}");
        if(File::exists($image_path)) {
            try{
                File::delete($image_path);
            }
            catch(\Exception $e) {
                return back()->with('fail','Error deleting the existing image');
            }
          
        }
        return back()->with('success','Image has been deleted');
    }

    public function deleteDates($id) {
        $delete= dates::where('id','=',$id)->first();
        $delete->delete();

        return back()->with('success','Date has been deleted');
    }

    public function deleteFoods($id) {
        $delete= menu::where('id','=',$id)->first();
        $delete->delete();

        return back()->with('success','Item has been deleted');
    }

    public function deleteCapacities($id) {
        $delete= capacity::where('id','=',$id)->first();
        $delete->delete();

        return back()->with('success','Capacity has been deleted');
    }

    public function deleteownerProfile($email) {
        $delete = banquetRegister::where('email','=',$email)->first();
        $date = dates::where('fk_banquet_id','=',$delete->id)->get();
        $menu = menu::where('fk_banquet_id','=',$delete->id)->get();
        $images = images::where('fk_banquet_id','=',$delete->id)->get();
        $capacity = capacity::where('fk_banquet_id','=',$delete->id)->first();
        if($capacity) {
            $capacity->delete();
        }

        if($date != null) {
        foreach($date as $dt) {
            $dt->delete();
        }
    }

        if($menu != null) {
        foreach($menu as $mn) {
            
            $mn->delete();
        }
    }
        if($images != null) {
            foreach($images as $im) {
                $image_path = public_path("banquet/{$im->path}");
                if(File::exists($image_path)) {
                    try{
                        File::delete($image_path);
                    }
                    catch(\Exception $e) {
                        return back()->with('fail','Error deleting the existing image');
                    }
                }
                $im->delete();
            }
        }

            $delete->delete();
            Session::pull('loginEmail');

        
        return redirect()->to(route('login'))->with('success','Account has been successfully deleted');
    }


    public function booknow() {
        return view('booking');
    }



    public function bookingform(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'guests' => 'required',
            
        ]);

        $temp1= User::where('email','=',Session::get('loginEmail'))->first();

        // $data = dates::where('','','')->
        // $capa = capacity::where('fk_banquet_id','=','')->first();
        // return view ("booking",compact('temp1'));

        if($temp1)
        {
            $temp1->firstname = $request->firstname;
            $temp1->lastname = $request->lastname;
            $temp1->email = $request->email;
            
            $temp1->save();


                return back()->with('success','Your booking has been recorded');
        }else{
                return back()->with('fail','Something went wrong');
            }
         

    }
    
}
