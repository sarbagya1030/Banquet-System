<?php

namespace App\Http\Controllers;

use App\Models\banquetRegister;
use App\Models\menu;
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
                             'capacities.banquet_capacity','capacities.2-wheeler','capacities.4-wheeler')
                             ->leftJoin('banquet_registers','banquet_registers.id','images.fk_banquet_id')
                             ->leftJoin('dates','dates.fk_banquet_id','banquet_registers.id')
                             ->leftJoin('menus','menus.fk_banquet_id','banquet_registers.id')
                             ->leftJoin('capacities','capacities.fk_banquet_id','banquet_registers.id')
                             ->get();
        // dd($details);
        return view('details',['details' => $details]);
    }

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

  

  
    
    
   
}
