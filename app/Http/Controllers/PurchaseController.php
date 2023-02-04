<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class PurchaseController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('isAdmin');
    }

    protected function addPurchaseView()
    {
        $products = Product::where('is_deleted', 0)->get();
        $outlets = Outlet::where('is_deleted', 0)->get();
        return view('admin/purchase/addPurchase')->with(compact('products', 'outlets'));
    }
    protected function addPurchase(Request $request)
    {

        $rules = [
            'outlet_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'date' => 'required|date',
            'total' => 'required|numeric',
            'paid' =>  'required|numeric',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add_purchase_view')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $purchase = new Purchase;
                $purchase->outlet_id = $data['outlet_id'];
                $purchase->product_id = $data['product_id'];
                $purchase->price = $data['price'];
                $purchase->quantity = $data['quantity'];
                $purchase->free_quantity = $data['free_quantity'] ? $data['free_quantity'] : 0;
                $purchase->date = $data['date'];
                $purchase->total = $data['total'];
                $purchase->paid = $data['paid'];
                $purchase->current_price = ($data['paid'] / ($data['quantity'] + ($data['free_quantity'] ? $data['free_quantity'] : 0)));
                $purchase->save();
                $product = Product::where('id', $data['product_id'])->first();
                $product->quantity += ($data['quantity'] + ($data['free_quantity'] ? $data['free_quantity'] : 0));
                $product->update();

                $inventory = Inventory::where('outlet_id', $data['outlet_id'])
                    ->where('product_id', $data['product_id'])->first();

                // echo $data['product_id'].'<br>';
                // echo $data['outlet_id'].'<br>';
                // echo '<pre>';
                // print_r($inventory);
                if ($inventory) {
                    $inventory->quantity += ($data['quantity'] + ($data['free_quantity'] ? $data['free_quantity'] : 0));
                    $inventory->update();
                } else {
                    $inventory = new Inventory;

                    $inventory->product_id = $data['product_id'];
                    $inventory->outlet_id = $data['outlet_id'];
                    $inventory->quantity = ($data['quantity'] + ($data['free_quantity'] ? $data['free_quantity'] : 0));

                    $inventory->save();
                }


                return redirect('add_purchase_view')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect('add_purchase_view')->with('failed', "operation failed");
            }
        }
    }

    protected function purchaseList()
    {
        $products = Product::where('is_deleted', 0)->get();
        $purchases = Purchase::Join('products', 'purchases.product_id', '=', 'products.id')
            ->Join('outlets', 'purchases.outlet_id', '=', 'outlets.id')
            ->select('purchases.id', 'purchases.product_id', 'purchases.price', 'purchases.current_price', 'purchases.total', 'purchases.paid', 'purchases.quantity', 'purchases.free_quantity', 'purchases.date', 'products.name', 'outlets.name as outlet_name', 'outlets.address')
            ->where('purchases.is_deleted', 0)
            ->get();
        return view('admin/purchase/purchaseList')->with(compact('purchases', 'products'));
    }

    protected function updatePuschase(Request $request){
        $rules = [
            'product_id' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'date' => 'required|date',
            'total' => 'required|numeric',
        ];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->route('purchase_list')
                	->withInput()
                	->withErrors($validator);
            		//return response();
		}
		else{
            $data = $request->input();
			try{
				$purchase = Purchase::find($data['id']);
                		$purchase->product_id = $data['product_id'];
                		$purchase->price = $data['price'];
                		$purchase->quantity = $data['quantity'];
                		$purchase->date = $data['date'];
                		$purchase->total = $data['total'];
				$purchase->update();
				return redirect()->route('purchase_list')->with('status', "Insert successfully");
                		}
			catch(Exception $e){
				return redirect()->route('purchase_list')->with('failed', "operation failed");
				}
			}
    }


    protected function deletePuschase(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];
        try {
            $purchase = Purchase::find($id);
            $purchase->is_deleted = 1;
            $purchase->update();

            return redirect()->route('purchase_list')
                ->withInput();
        } catch (Exception $e) {
            return "Not Delete";
        }
    }
}
