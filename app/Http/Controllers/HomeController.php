<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\User;
use App\Models\Employe;
use App\Models\Seles;
use App\Models\Shift;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

            // $productsInStock = Inventory::where('outlet_id', auth()->user()->outlet_id)
            // ->where('quantity', '>', 0 )
            // ->get();
            // $totalItem = $productsInStock->count();
            // $totalPrice = 0;

            // foreach($productsInStock as $productInStock){
            //     $productInfo = Product::where('id', $productInStock->product_id)->first();
            //     $totalPrice += ($productInfo->price_per_unite * $productInfo->quantity);
            // }

            // $totalProduct = Inventory::where('outlet_id', auth()->user()->outlet_id)
            // ->where('quantity', '>', 0 )
            // ->sum('quantity');

            $var = ['from_outlet_id', '=' ,auth()->user()->outlet_id];
            if(auth()->user()->user_role == 'Admin'){
                $var = ['from_outlet_id', '!=' , 0];
            }

            $shifts = Shift::join('products', 'products.id', '=', 'shifts.product_id')
            ->join('outlets', 'outlets.id', '=', 'shifts.from_outlet_id')
            ->where('to_outlet_id', auth()->user()->outlet_id)
            ->where('status', 'pending')
            ->orderBy('shift_no', 'asc')
            ->get();

            $requests = $shifts->groupBy('shift_no');
            $shiftRequest = $requests->count();

            $shifts = Shift::join('products', 'products.id', '=', 'shifts.product_id')
            ->join('outlets', 'outlets.id', '=', 'shifts.from_outlet_id')
            ->where([$var])
            ->where('status', 'pending')
            ->orderBy('shift_no', 'asc')
            ->get();

            $requests = $shifts->groupBy('shift_no');
            $pendingRequest = $requests->count();



           return view('home')->with(compact('pendingRequest','shiftRequest'));

    }



    protected function paginateChecking(){

                    //         SELECT * FROM ( SELECT *, ROW_NUMBER() OVER (ORDER BY EmpId) AS row FROM MyTable) temp
                    // WHERE row >= 10 AND row <= 20
            return view('dddddd');
    }
    protected function getdata(Request $request){

        //return 'wellllllllllllllllllcccccccccccoooooooooooooo';

        $results = Seles::orderBy('id')->paginate(500);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                //$artilces.='<div class="card mb-2"> <div class="card-body">'.$result->id.' <h5 class="card-title">'.$result->post_name.'</h5> '.$result->post_description.'</div></div>';
                $artilces.='<tr><td>'.$result->id.'</td></tr>';
            }
            return $artilces;
        }
        return view('welcome');
    }
}
