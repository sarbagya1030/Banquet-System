<?php

namespace App\Http\Controllers;
use App\Models\banquetRegister;
use App\Models\capacity;
use App\Models\dates;
use App\Models\menu;
use App\Models\images;
use App\Models\orders;
use App\Models\User;
use App\Models\booking;
use App\Models\reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

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
            return back()->with('success','You have added image successfully');
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


    public function booknow($id) {
        $user = User::where('email',Session::get('loginEmail'))->first();
        $capacity = capacity::where('fk_banquet_id',$id)->first();
        $date = dates::where('fk_banquet_id',$id)->get();
        return view('booking',compact('id','date','capacity','user'));
    }



    public function bookingform(Request $request,$id) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'guests' => 'required',

        ]);
        $temp1= User::where('email','=',Session::get('loginEmail'))->first();

        $data = dates::where("fk_banquet_id",$id)->get();
        $capa = capacity::where('fk_banquet_id',$id)->first();
        $owner = banquetRegister::where('id',$id)->first();

    
        if($temp1)
        {
            $owner = banquetRegister::where('id',$id)->first();
            $temp1= User::where('email','=',Session::get('loginEmail'))->first();
            $check = orders::where('orderedDate',$request->date)->first();
            if(is_null($check)){

                $value = new orders();
                $value->firstname = $request->firstname;
                $value->lastname = $request->lastname;
                $value->email = $request->email;
                $value->phone = $request->phone; 
                $value->orderedDate = $request->date; 
                $value->guestsNumber = $request->guests; 
                $value->fk_user_id = $temp1->id; 
                $value->fk_banquet_id = $owner->id; 
                $value->paymentstatus = 'unpaid';
                $value->isCompleted = 0;
                $value->save();
                foreach($data as $dt) {
                    if($dt->date==$request->date) {
                        $dt->delete();
                    }
                }
            }


            $banquet = banquetRegister::where('id', $id)->first();
            $userEmail = Session::get('loginEmail');
            $productItems = [];
    
                \Stripe\Stripe::setApiKey('sk_test_51O79rnGfKaSVwu78tNwb4dpWyqIUFhkZiAeFyMe8E9CsusswOeFxCyFgZOSr7ALIgzdWyerfHYTiKPC6hEelX5OD00Y54cxh0U');
                $quantity = 1;
                $price = intval($banquet->book_amount);
                $productItems[] = [
                    'price_data' => [
                        'product_data' => [
                            'name' => $banquet->banquetname,
                        ],
                        'currency' => 'NPR',
                        'unit_amount' => $price . '00',
                    ],
                    'quantity' => $quantity
                ];
    
                $checkoutSession = \Stripe\Checkout\Session::create([
                    'line_items' => [$productItems],
                    'mode' => 'payment',
                    'customer_email' => $userEmail,
                    'success_url' => url('/success/' . $value->id),
                    'cancel_url' => url('/fail/', $value->id),
                ]);
                return redirect()->away($checkoutSession->url);
        }else{
                return back()->with('fail','Something went wrong');
        }
    }


    public function successpay($id) {

        $banquet = orders::where('id',$id)->first();
        $banquet->paymentstatus = "Paid";
        $banquet->save();
        $banquetEm = banquetRegister::where('id',$banquet->fk_banquet_id)->first();
        $banquetEmail = $banquetEm->email;
        Mail::send('displayBooking', ['id' => $id], function ($message) use ($banquetEmail) {
            $message->to($banquetEmail);
            $message->subject('New Booking Request');
        });
        return redirect()->to(url('/booking/'.$banquet->fk_banquet_id))->with('success','Your booking has been recorded');
    }

    public function failpay($id) {
        $banquet = orders::where('id',$id)->first();
        $ban_id = $banquet->fk_banquet_id;
        $delete = orders::where('id','=',$id)->first();
        $delete->delete();
            
        return redirect()->to(url('/booking/'.$ban_id))->with('fail','Your Payment could not be made, try again later!!');
    }


    public function searchPost(Request $request)
    {
        $query = $request->input('search');

        // Get the logged-in user's data (assuming this is what you intended)
        $data = User::where('id', '=', Session::get('loginId'))->first();
        $post = banquetRegister::all();
        // Perform your search logic on the 'post' model
        $results = banquetRegister::where('banquetname', 'like', '%' . $query . '%')
            // ->orWhere('description', 'like', '%' . $query . '%')
            // ->orWhere('name', 'like', '%' . $query . '%')
            // Add more columns as needed
            ->get();

        // Fetch all posts 
        return redirect()->to(url('/dashboard'))->with('results',$results);
    }

    public function rating($id) {
        return view('review',compact('id'));
    }

    public function reviewpost(Request $request, $id) {
        $banquet = banquetRegister::where('id',$id)->first();
        
        $review = new reviews();
        $user = User::where('email',Session::get('loginEmail'))->first();
        $review->fk_user_id = $user->id;
        $review->fk_banquet_id = $id;
        $review->rating = $request->rating;
        $review->experience = $request->description;
        $review->save();
        $select = reviews::where('fk_banquet_id',$id)->get();

        if($select){
            $temp1 = count($select);
            $temp = 0;
            foreach($select as $sel){
                $temp = $temp + $sel->rating;

            }
            $temp3 = $temp/$temp1;
            $banquet->rating = round($temp3);
            // dd($banquet);
            $banquet->update();
        }
        return redirect()->to(url('/dashboard'));
    }

    public function reviewshow($id) {
        $reviews = reviews::where('fk_banquet_id', $id)->get();
        return view('showreview',compact('reviews'));
    }

 
}
