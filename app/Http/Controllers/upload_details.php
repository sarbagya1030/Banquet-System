<?php

namespace App\Http\Controllers;

use App\Models\banquetRegister;
use App\Models\capacity;
use App\Models\dates;
use App\Models\menu;
use App\Models\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class upload_details extends Controller
{
    public function detail() {
        $details = DB::table('images')
                             ->select('banquet_registers.*',
                             'images.path',
                             'dates.date',
                             'menus.foodname','menus.type','menus.price',
                             'capacities.banquet_capacity','capacities.twowheeler','capacities.fourwheeler')
                             ->leftJoin('banquet_registers','banquet_registers.id','images.fk_banquet_id')
                             ->leftJoin('dates','dates.fk_banquet_id','banquet_registers.id')
                             ->leftJoin('menus','menus.fk_banquet_id','banquet_registers.id')
                             ->leftJoin('capacities','capacities.fk_banquet_id','banquet_registers.id')
                             ->get();
        // dd($details);
        return view('details',['details' => $details]);
    }

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

    public function recorddelete() {
        return view ("recorddelete");
    }


   
}
