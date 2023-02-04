<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShiftCart;
use App\Models\Shift;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Exception;git 

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('isAdmin');
    }

    protected function addProductView()
    {
        return view('admin/product/addProduct');
    }

    protected function addProduct(Request $request)
    {
        $rules = [
            'product_name' => 'required|string|min:3|max:255',
            'brand' => 'required|string|min:3|max:255',
            'unit' => 'required|string',
            'price_per_unite' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add_product_view')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                //print_r($data);
                $product = new Product;
                $product->name = $data['product_name'];
                $product->brand = $data['brand'];
                $product->barcode = $data['barcode'];
                $product->unit = $data['unit'];
                $product->price_per_unite = $data['price_per_unite'];
                $product->offer_mrp = $data['offer_mrp'];
                $product->expire_date = $data['expire_date'];
                $product->description = $data['product_description'];
                if (isset($data['offer'])) {
                    $product->offer = true;
                } else {
                    $product->offer = false;
                }

                $product->save();
                return redirect('add_product_view')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect('add_product_view')->with('failed', "operation failed");
            }
        }
    }

    protected function getProductAvableQuantity(Request $request)
    {


        $data = $request->all();
        $productId = $data['productId'];
        //return $productId.' pi';
        $product = Inventory::where('outlet_id', auth()->user()->outlet_id)
            ->where('product_id', $productId)
            ->first();

        return $product->quantity;
    }

    protected function getProductAvableQuantityToShift(Request $request)
    {



        //$avableQuantity = $this->getProductAvableQuantity($request);

        //return $avableQuantity;
        $data = $request->all();
        $productId = $data['productId'];
        $outletId = $data['outletId'];
        $formOutlet = auth()->user()->outlet_id;

        if (auth()->user()->user_role == 'Admin') {
            $formOutlet =  $data['sender_outlet_id'];
        }

        $product = Inventory::where('outlet_id', $formOutlet)
            ->where('product_id', $productId)
            ->first();
        $avableQuantity = $product->quantity;

        // return $avableQuantity;

        $shiftCartItem = ShiftCart::where('from_outlet_id', $formOutlet)
            ->where('to_outlet_id', $outletId)
            ->where('product_id', $productId)
            ->first();
        if ($shiftCartItem) return ($avableQuantity - $shiftCartItem->quantity);
        else return ($avableQuantity);
    }


    protected function updateProduct(Request $request)
    {
        $rules = [
            'product_name' => 'required|string|min:3|max:255',
            'brand' => 'required|string|min:3|max:255',
            'unit' => 'required|string',
            'price_per_unite' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('product_list')
                ->withInput()
                ->withErrors($validator);

            //return response();
        } else {
            $data = $request->input();
            try {
                $product = Product::where('id', $data['id'])->first();
                $product->name = $data['product_name'];
                $product->brand = $data['brand'];
                $product->unit = $data['unit'];
                $product->barcode = $data['barcode'];
                $product->price_per_unite = $data['price_per_unite'];
                $product->offer_mrp = $data['offer_mrp'];
                $product->expire_date = $data['expire_date'];
                $product->description = $data['product_description'];
                if (isset($data['offer'])) {
                    $product->offer = true;
                } else {
                    $product->offer = false;
                }
                $product->update();
                return redirect('product_list')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect('product_list')->with('failed', "operation failed");
            }
        }
    }

    protected function getProductDetailsById(Request $request)
    {
        $id = $request->id;
        $product = Product::where('id', $id)->first();

        return $product;
    }

    protected function productList()
    {
        $products = Product::where('is_deleted', 0)->get();
        return view('admin/product/productList')->with(compact('products'));
    }

    protected function productInStock(Request $request)
    {
        $data = $request->all();
        $outletId;
        if (isset($data['outlet'])) {
            $outletId = $data['outlet'];
        } else {
            $data['outlet'] = auth()->user()->outlet_id;
            $outletId =  $data['outlet'];
        }
        $products = Inventory::join('products', 'inventories.product_id', '=', 'products.id')
            ->where('inventories.outlet_id', $outletId)
            ->where('inventories.quantity', '>', 0)
            ->select('products.id', 'products.name', 'products.brand', 'products.barcode', 'products.unit', 'products.price_per_unite', 'products.offer', 'products.offer_mrp', 'products.expire_date', 'inventories.quantity', 'products.description')
            ->get();
        $listType = 'outlet';
        $outlets = Outlet::get();
        return view('admin/product/productList')->with(compact('products', 'listType', 'outlets', 'data'));
    }

    protected function shiftProduct()
    {
        $products = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
            ->where('inventories.outlet_id', auth()->user()->outlet_id)
            ->where('is_deleted', 0)
            ->where('inventories.quantity', '>', 0)
            ->select('products.id', 'products.name', 'products.brand', 'products.unit', 'products.price_per_unite', 'inventories.quantity', 'products.description')
            ->get();

        // $outlets = User::join('outlets', 'users.outlet_id', '=', 'outlets.id')
        // ->select('users.id as user_id', 'users.name as user_name', 'outlets.id as outlet_id', 'outlets.name as outlate_name', 'outlets.address')
        // ->where('users.is_deleted', 0)
        // ->get();

        $outlets = Outlet::select('outlets.id as outlet_id', 'outlets.name as outlate_name', 'outlets.address')
            ->where('outlets.is_deleted', 0)
            ->get();

        return view('admin/product/shiftProduct')->with(compact('products', 'outlets',));
    }

    protected function addShiftToCart(Request $request)
    {
        $rules = [
            'outletId' => 'required|numeric',
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response();
        } else {
            $data = $request->input();

            $formOutlet = auth()->user()->outlet_id;
            if (auth()->user()->user_role == 'Admin') {
                $formOutlet = $data['sender_outlet_id'];
            }

            try {
                $shiftCart = ShiftCart::where('from_outlet_id', $formOutlet)
                    ->where('to_outlet_id', $data['outletId'])
                    ->where('product_id', $data['productId'])
                    ->first();

                if ($shiftCart) {
                    $shiftCart->quantity += $data['quantity'];
                    $shiftCart->update();
                } else {
                    $shiftCart = new ShiftCart;
                    $shiftCart->from_outlet_id  = $formOutlet;
                    $shiftCart->to_outlet_id = $data['outletId'];
                    $shiftCart->product_id   = $data['productId'];
                    $shiftCart->quantity   = $data['quantity'];
                    $shiftCart->save();
                }

                return 'success';
            } catch (Exception $e) {
                return response();
            }
        }
    }

    protected function addShiftForm(Request $request)
    {


        $formOutlet = auth()->user()->outlet_id;
        if (auth()->user()->user_role == 'Admin') {
            $formOutlet = $request->sender_outlet_id;
        }

        $carts = ShiftCart::join('products', 'shift_carts.product_id', '=', 'products.id')
            ->where('shift_carts.from_outlet_id', $formOutlet)
            ->where('shift_carts.to_outlet_id', $request->outletId)
            ->select('shift_carts.id', 'shift_carts.product_id', 'shift_carts.quantity', 'products.name')
            ->get();

        foreach ($carts as $cart) {
            $inventory = Inventory::where('product_id', $cart->product_id)
                ->where('outlet_id', $formOutlet)
                ->first();

            if ($inventory->quantity < $cart->quantity) {
                if ($inventory->quantity == 0) {
                    $cart->delete();
                } else {
                    $cart->quantity = $inventory->quantity;
                    $cart->update();
                }
            }
        }

        $carts = ShiftCart::join('products', 'shift_carts.product_id', '=', 'products.id')
            ->where('shift_carts.from_outlet_id', $formOutlet)
            ->where('shift_carts.to_outlet_id', $request->outletId)
            ->select('shift_carts.id', 'shift_carts.quantity', 'products.name')
            ->get();

        return view('admin/product/shiftForm')->with(compact('carts'));
    }


    protected function deleteAddShiftItem(Request $request)
    {
        $shiftItem = ShiftCart::where('id', $request->id)->first();
        // $inventory = Inventory::where('product_id', $shiftItem->product_id)
        //         ->where('outlet_id', auth()->user()->outlet_id)
        //         ->first();
        // $inventory->quantity += $shiftItem->quantity;
        // $inventory->update();
        $shiftItem->delete();
    }

    protected function addToShift(Request $request)
    {
        $formOutlet = auth()->user()->outlet_id;
        if (auth()->user()->user_role == 'Admin')
            $formOutlet = $request->sender_outlet_id;

        $mx = Shift::where('from_outlet_id', $formOutlet)->max('shift_no');
        if ($mx == null) {
            $mx = 10;
        }

        $shifts = ShiftCart::where('from_outlet_id',  $formOutlet)
            ->where('to_outlet_id', $request->outlet_id)
            ->get();

        if ($shifts->count() > 0) {
            try {
                foreach ($shifts as $data) {
                    $shift = new Shift;

                    $shift->shift_no = (($formOutlet) . (substr($mx, 1) + 1));
                    $shift->from_outlet_id = $data->from_outlet_id;
                    $shift->to_outlet_id = $data->to_outlet_id;
                    $shift->product_id = $data->product_id;
                    $shift->quantity = $data->quantity;
                    $shift->status = 'pending';
                    $shift->save();
                    $data->delete();

                    $inventory = Inventory::where('product_id', $data->product_id)
                        ->where('outlet_id',  $formOutlet)
                        ->first();
                    $inventory->quantity -= $data->quantity;
                    $inventory->update();
                }
                return redirect('shift_product')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect()->route('shift_product')->with('failed', "operation failed");
            }
        } else {
            return redirect()->route('shift_product')->with('failed', "operation failed");
        }
    }

    protected function pendingProduct()
    {
        return view('admin/product/PendingProduct');
    }

    protected function shiftingRequest()
    {



        $var = ['from_outlet_id', '=', auth()->user()->outlet_id];
        if (auth()->user()->user_role == 'Admin') {
            $var = ['from_outlet_id', '!=', 0];
        }

        $shifts = Shift::join('products', 'products.id', '=', 'shifts.product_id')
            ->join('outlets', 'outlets.id', '=', 'shifts.to_outlet_id')
            ->join('outlets as os', 'os.id', '=', 'shifts.from_outlet_id')
            ->where([['status', '=', 'pending'], $var])
            ->orderBy('shift_no', 'asc')
            ->select('shifts.id', 'shifts.to_outlet_id', 'shifts.shift_no', 'shifts.product_id', 'shifts.quantity', 'products.name as product_name', 'outlets.name as outlet_name', 'os.name as from_outlet_name')
            ->get();



        // return 'comm';

        $requests = $shifts->groupBy('shift_no');

        return view('admin.product.pendingRequestView')->with(compact('requests'));
    }

    protected function cancelSendedShiftingRequest(Request $request)
    {
        $shiftNo = $request->shiftNo;

        $shifts = Shift::where('shift_no', $shiftNo)
            ->where('status', 'pending')
            ->get();

        foreach ($shifts as $shift) {
            $inventor = Inventory::where('outlet_id', $shift->from_outlet_id)
                ->where('product_id', $shift->product_id)
                ->first();


            if ($inventor) {
                $inventor->quantity += $shift->quantity;
                $inventor->update();
            } else {
                $inventor = new Inventory;
                $inventor->product_id = $shift->product_id;
                $inventor->outlet_id = $shift->from_outlet_id;
                $inventor->quantity = $shift->quantity;
                $inventor->save();
            }

            $sift = Shift::where('id', $shift->id)->first();
            $sift->status = 'canceled';
            $sift->update();
        }
        return $this->shiftingRequest();
    }

    protected function getPendingProduct()
    {
        $shifts = Shift::join('products', 'products.id', '=', 'shifts.product_id')
            ->join('outlets', 'outlets.id', '=', 'shifts.from_outlet_id')
            ->where('to_outlet_id', auth()->user()->outlet_id)
            ->where('status', 'pending')
            ->orderBy('shift_no', 'asc')
            ->select('shifts.id', 'shifts.from_outlet_id', 'shifts.shift_no', 'shifts.product_id', 'shifts.quantity', 'products.name as product_name', 'outlets.name as outlet_name')
            ->get();

        $requests = $shifts->groupBy('shift_no');
        if (!($requests->count())) {
            return ' ';
        }

        // $sl = 0; $dx = 0; $index = 0;
        // $ar = [];
        // $requests = [];
        // foreach($shifts as $key => $shift){
        //     if($shift->shift_no != $sl){
        //         unset($ar);
        //         $ar = [];
        //         $dx = 0;
        //         $sl = $shift->shift_no;
        //     }

        //     $ar[$dx++] = $shift;

        //     if((!isset($shifts[$key+1])) || (isset($shifts[$key+1]) && $shifts[$key+1]->shift_no != $sl)){
        //        $requests[$index++] = $ar;
        //     }
        // }


        //return $requests;
        return view('admin/product/requestView')->with(compact('requests'));
    }

    protected function shiftrequestPage()
    {
        return view('admin/product/shiftingRequest');
    }


    protected function getOutletProductList(Request $request)
    {
        $outletId = $request->senderOutletId;


        $products = Product::join('inventories', 'products.id', '=', 'inventories.product_id')
            ->where('inventories.outlet_id', $outletId)
            ->where('is_deleted', 0)
            ->where('inventories.quantity', '>', 0)
            ->select('products.id', 'products.name', 'products.brand', 'products.unit', 'products.price_per_unite', 'inventories.quantity', 'products.description')
            ->get();


        $options = (string)(" <option value=\"0\" disabled selected hidden>Select Product</option>");

        foreach ($products as $product) {

            $options .= (string)("<option value=\"{$product->id}\">{$product->name}</option>");
        }


        return (string)$options;
    }

    protected function acceptShiftRequest(Request $request)
    {
        $shifts = $request->shifts;
        //$shifts = Shift::where('shift_no', $shiftNo)->get();

        foreach ($shifts as $id) {
            $shift = Shift::where('id', $id)->first();

            $inventor = Inventory::where('outlet_id', auth()->user()->outlet_id)
                ->where('product_id', $shift->product_id)
                ->first();

            if ($inventor) {
                $inventor->quantity += $shift->quantity;
                $inventor->update();
            } else {
                $inventor = new Inventory;
                $inventor->product_id = $shift->product_id;
                $inventor->outlet_id = auth()->user()->outlet_id;
                $inventor->quantity = $shift->quantity;
                $inventor->save();
            }

            $sift = Shift::where('id', $shift->id)->first();
            $sift->status = 'accepted';
            $sift->update();
        }

        return $this->getPendingProduct();
    }

    protected function cancelShiftRequest(Request $request)
    {
        $shifts = $request->shifts;

        //$shifts = Shift::where('shift_no', $shiftNo)->get();

        foreach ($shifts as $id) {

            $shift = Shift::where('id', $id)->where('status', 'pending')->first();

            if ($shift) {
                $inventor = Inventory::where('outlet_id', $shift->from_outlet_id)
                    ->where('product_id', $shift->product_id)
                    ->first();


                if ($inventor) {
                    $inventor->quantity += $shift->quantity;
                    $inventor->update();
                } else {
                    $inventor = new Inventory;
                    $inventor->product_id = $shift->product_id;
                    $inventor->outlet_id = $shift->from_outlet_id;
                    $inventor->quantity = $shift->quantity;
                    $inventor->save();
                }

                $sift = Shift::where('id', $shift->id)->first();
                $sift->status = 'not accepted';
                $sift->update();
            }
        }

        return $this->getPendingProduct();
    }
}
