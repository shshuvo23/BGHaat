<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Employe;
use App\Models\Seles;
use App\Models\CoustomerSeles;
use App\Models\Cart;
use App\Models\CustomerCart;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\User;
use App\Models\Inventory;
use App\Models\CustomerAccount;
use App\Models\EmployeAccount;
use App\Models\Invoice;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SelesController extends Controller{

    public function __construct(){

    }

    protected function addSalesPageForEmploye(){
        $outlets = Outlet::where('is_deleted', 0)->get();
        // $products = Product::where('is_deleted', 0)->where('quantity', '>', 0)->get();
        $products = Product::join('inventories','products.id', '=', 'inventories.product_id')
                    ->where('inventories.outlet_id', auth()->user()->outlet_id)
                    ->where('is_deleted', 0)
                    ->where('inventories.quantity','>', 0)
                    ->select('products.id','products.name','products.brand','products.unit','products.price_per_unite','products.offer_mrp', 'products.expire_date', 'inventories.quantity','products.description')
                    ->get();
        $employes = Employe::where('is_deleted', 0)->get();


        $users = User::join('outlets', 'users.outlet_id', '=', 'outlets.id')
        ->select('users.id as user_id', 'users.name as user_name', 'outlets.name as outlate_name', 'outlets.address')
        ->where('users.is_deleted', 0)
        ->get();

       return view('sales/addSalesForEmploye')->with(compact('outlets','products','users', 'employes'));
    }

    protected function addSeleToCart(Request $request){


        $rules = [
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric',
            'unit' => 'required|string',
		];

		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return 'error';
		}
		else{
           $data = $request->all();

			try{
				$cart = new Cart;
                $cart->product_id = $data['productId'];
                $cart->outlet_id = auth()->user()->outlet_id;
                $cart->employe_id = $data['employeId'];
                $cart->user_id = auth()->user()->id;
                $cart->quantity = $data['quantity'];
                $cart->date =  date('Y-m-d');
				$cart->save();

               return 'success';
			}
			catch(Exception $e){
				return 'error';
			}
		}
    }


    protected function addSelesForm(Request $request){

        $data = $request->all();
        $employeId = $data['employeId'];


        $carts = Cart::join('products','carts.product_id', '=', 'products.id')
        ->where('carts.outlet_id', auth()->user()->outlet_id)
        ->where('carts.employe_id', $employeId)
        ->select('carts.id',
            'carts.product_id',
            'products.unit',
            'products.price_per_unite',
            'products.offer',
            'products.offer_mrp',
            'products.expire_date',
            'carts.quantity',
            'products.name')
        ->get();


        $qty = []; $total = 0;
        foreach($carts as $cart){
            // return $cart->seles_type;
                if(isset($qty[$cart->product_id])){
                    $qty[$cart->product_id] += $cart->quantity;
                }
                else{
                    $qty[$cart->product_id] = $cart->quantity;
                }

                $price = $cart->price_per_unite;
                if($cart->offer && $cart->expire_date >= date('Y-m-d')){
                    $price = $cart->offer_mrp;
                }

                $total +=  $price * $cart->quantity;
        }

        $table = view('layouts/addSelesForm')->with(compact('carts'));


        return response()->json([
            'table' => (string)$table,
            'qty' => $qty,
            'total' => $total,
        ]);
    }

    protected function deleteAddSelesItem(Request $request){

        $data = $request->all();
        $id = $data['id'];
        $employeId = $data['employeId'];


        //get seles item from carts table using id
        $cart = Cart::join('products', 'carts.product_id', '=', 'products.id')
        ->where('carts.id', $id)
        ->select('carts.id',  'carts.quantity', 'products.id', 'products.price_per_unite', 'products.offer', 'products.offer_mrp', 'products.expire_date')
        ->first();


        $price = $cart['price_per_unite'];
        if($cart['offer'] && $cart['expire_date'] >= date('Y-m-d')) $price = $cart['offer_mrp'];

        $quantity = $cart['quantity'];
        // $selesType = $cart['seles_type'];

        // geting total price
        $total_price = ($price * $quantity);

        // remove this item from the table

        Cart::where('id', $id)->delete();

        $rows = $this->addSelesForm($request);

        return response()->json([
            'price' => $total_price,
            'rows' => $rows,
            // 'selesType' => (string)$selesType,
        ]);
    }

    protected function purchaseLimite(Request $request){

        $data = $request->all();

        $employeId = $data['employeId'];
        $employe = Employe::where('id', $employeId)->first();
        $date = date('Y-m');


        $creditPurchaseLimit = ($employe['credit_limit'] / 100)*$employe['salary'];


        $employeAccount = EmployeAccount::where('employe_id', $employeId)->sum('due');
        $purchasedOnCredit = 0;
        if($employeAccount) $purchasedOnCredit = $employeAccount;

         $canPurchaseOnCredit =  $creditPurchaseLimit - $purchasedOnCredit;

        return response()->json([
            'canPurchaseOnCredit' => $canPurchaseOnCredit,
            'employe' => $employe,
           // 'total' => $total,
        ]);
    }

    protected function addSeles(Request $request){
        // return auth()->user()->outlet_id;

        $data = $request->all();
        $employeId = $data['EmployeI_ID'];
        $employe = Employe::where('id', $employeId)->first();
        $outlet = Outlet::where('id', auth()->user()->outlet_id)->first();

        $invoiceNo = Invoice::max('invoice_no');
        if($invoiceNo == null ){$invoiceNo = 1000;}

        $Carts = Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->where('outlet_id', auth()->user()->outlet_id)
        ->where('employe_id', $employeId)
        ->select(
            'carts.id',
            'carts.product_id',
            'carts.outlet_id',
            'carts.employe_id',
            'carts.quantity',
            'products.name',
            'products.unit',
            'products.price_per_unite',
            'products.offer',
            'products.offer_mrp',
            'products.expire_date',
        )
        ->get();

        if($Carts->count()>0){

            try{
                    $carts = [];
                    $carte = [];
                    $tf = true;

                    $invoice = new Invoice;
                    foreach($Carts as $cart){
                        $product = Inventory::where('product_id', $cart->product_id)
                        ->where('outlet_id', auth()->user()->outlet_id)->first();

                        if($product->quantity >= $cart->quantity){
                            if($tf){
                                $paid = $request->paid;
                                $change = $request->change;

                                if($paid == null){$paid = 0;}
                                if($change == null){$change = 0;}
                                $paid -= $change;

                                $invoice->invoice_no = (int)$invoiceNo+1;
                                $invoice->outlet_id = auth()->user()->outlet_id;
                                $invoice->total = $request->total;
                                $invoice->paid = $paid;

                                $invoice->save();
                                $tf = false;
                            }
                            Seles::insert([
                            'product_id' =>  $cart->product_id,
                            'outlet_id' =>  $cart->outlet_id,
                            'employe_id' => $cart->employe_id,
                            'unit' =>  $cart->unit,
                            'price_per_unite' =>  ($cart->offer && $cart->expire_date >= date('Y-m-d')) ? $cart->offer_mrp : $cart->price_per_unite,
                            'quantity' =>  $cart->quantity,
                            'total' =>  ((($cart->offer && $cart->expire_date >= date('Y-m-d')) ? $cart->offer_mrp : $cart->price_per_unite) * $cart->quantity),
                            'sales_no' => $invoice->id,
                            'date'=> date('Y-m-d'),
                            ]);

                            $product->quantity -= $cart->quantity;
                            $product->update();
                            $mainProduct = Product::where('id', $cart->product_id)->first();
                            $mainProduct->quantity -= $cart->quantity;
                            $mainProduct->update();
                            array_push($carts, $cart);
                        }
                        else{
                            array_push($carte, $cart);
                        }
                       Cart::where('id', $cart->id)->delete();
                    }


                    $account = EmployeAccount::where('employe_id', $employeId)
                    ->where('outlet_id', auth()->user()->outlet_id)->first();
                    if($account){
                        $account->due += $request->due;
                        $account->update();
                    }else{
                        $account = new EmployeAccount;
                        $account->employe_id = $employeId;
                        $account->outlet_id = auth()->user()->outlet_id;
                        $account->due = $request->due;
                        $account->save();
                    }

                    session()->put('carte', $carte);

                    $invoiceId = $invoice->id;
                    return redirect()->route('get_invoice_view',compact('invoiceId'));

                }catch(Exception $e){
                    return redirect()->route('add_sales_for_employe')->with('failed',"operation failed");
                }
            }
            else{
                return redirect()->route('add_sales_for_employe')->with('failed',"operation failed");
            }
    }

    protected function getSalesLListTable(Request $request){
        $data = $request->all();

        if($data['from_date'] == null){
            $data['from_date'] = "2022-01-01";
        }
        if($data['to_date'] == null){
            $data['to_date'] = date('Y-m-d');
        }



        if(auth()->user()->user_role == "outlet user"){
            $data['outlet'] = auth()->user()->outlet_id;
        }

        $sales = Seles::join('outlets', 'seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'seles.product_id', '=', 'products.id')
        ->join('employes', 'seles.employe_id', '=', 'employes.id')
        ->join('invoices', 'seles.sales_no', '=', 'invoices.id')
        ->where('seles.is_deleted', 0)
        ->select('seles.id',
            'seles.unit',
            'seles.price_per_unite',
            'seles.quantity',
            'seles.date',
            'invoices.invoice_no as sales_no',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'employes.id_card_number',
            'employes.contact_number',
            'seles.employe_id',
            'employes.name as employe_name',
            )
        ->get();

        $customerSales = DB::table('customer_seles')->join('outlets', 'customer_seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'customer_seles.product_id', '=', 'products.id')
        ->join('customers', 'customer_seles.customer_id', '=', 'customers.id')
        ->join('invoices', 'customer_seles.sales_no', '=', 'invoices.id')
        ->where('customer_seles.is_deleted', 0)
        ->select('customer_seles.id',
            'customer_seles.unit',
            'customer_seles.price_per_unite',
            'customer_seles.quantity',
            'customer_seles.date',
            'customer_seles.customer_id',
            'invoices.invoice_no as sales_no',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'customers.contact_no',
            'customers.name as customer_name',
            )
        ->get();

        //return view('sales/salesLiatTable')->with(compact('sales','customerSales','data'));

        $employes = Employe::where('is_deleted', 0)->get();
        $customers = Customer::where('is_deleted', 0)->get();
        $outlets = Outlet::get();
        return view('sales/salesList')->with(compact('outlets','sales','customerSales','data','employes','customers'));


    }




























    protected function addSalesPageForCustomer(){
        $outlets = Outlet::where('is_deleted', 0)->get();
        $products = Product::join('inventories','products.id', '=', 'inventories.product_id')
            ->where('inventories.outlet_id', auth()->user()->outlet_id)
            ->where('is_deleted', 0)
            ->where('inventories.quantity','>', 0)
            ->select('products.id','products.name','products.brand','products.unit','products.price_per_unite','inventories.quantity','products.description')
            ->get();

        $users = User::join('outlets', 'users.outlet_id', '=', 'outlets.id')
        ->where('users.is_deleted', 0)
        ->select('users.id as user_id', 'users.name as user_name', 'outlets.name as outlate_name', 'outlets.address')
        ->get();

        $customers = Customer::get();


        return view('sales/addSalesForCustomer')->with(compact('outlets','customers','products','users'));
    }

    protected function getCustomerPurchaseHistory(Request $request){


        $carts = DB::table('customer_carts')->join('products','customer_carts.product_id', '=', 'products.id')
        ->where('customer_carts.outlet_id', auth()->user()->outlet_id)
        ->select('customer_carts.id', 'customer_carts.product_id','customer_carts.quantity', 'products.unit', 'products.price_per_unite', 'products.offer', 'products.offer_mrp', 'products.expire_date', 'products.name')
        ->get();




        $qty = [];$total = 0;
        foreach($carts as $cart){

            if(isset($qty[$cart->product_id])){
                $qty[$cart->product_id] += $cart->quantity;
            }
            else{
                $qty[$cart->product_id] = $cart->quantity;
            }


            $price = $cart->price_per_unite;
            if($cart->offer && $cart->expire_date >= date('Y-m-d')){
                $price = $cart->offer_mrp;
            }
            $price *= $cart->quantity;

            $total += $price;

        }



        $table =  view('layouts/addSelesForm')->with(compact('carts'));

        return response()->json([

            'qty' => $qty,
            'table' => (string)$table,
            'total' => $total,
        ]);

    }

    protected function addCustomerSelesForm(Request $request){



        $carts = DB::table('customer_carts')->join('products','customer_carts.product_id', '=', 'products.id')
        ->where('customer_carts.outlet_id', auth()->user()->outlet_id)
        ->select('customer_carts.id','customer_carts.product_id', 'products.unit', 'products.price_per_unite', 'products.offer', 'products.offer_mrp', 'products.expire_date', 'customer_carts.quantity', 'products.name')
        ->get();

        $total = 0;
        $qty = [];
        foreach($carts as $cart){
            if(isset($qty[$cart->product_id])){$qty[$cart->product_id] += $cart->quantity;}
            else{$qty[$cart->product_id] = $cart->quantity;}
            $price = $cart->price_per_unite;
            if($cart->offer && $cart->expire_date >= date('Y-m-d')){
                $price = $cart->offer_mrp;
            }
            $price *= $cart->quantity;

            $total += $price;
        }

        $table = view('layouts/addSelesForm')->with(compact('carts'));

        return response()->json([
            'table' => (string)$table,
            'qty' => $qty,
            'total' => $total,
        ]);

    }

    protected function addCustomerSelesToCart(Request $request){


        $rules = [
            'productId' => 'required|numeric',
            'quantity' => 'required|numeric',
		];
		$validator = Validator::make($request->all(),$rules);



		if ($validator->fails()) {return 'error';}
		else{

           $data = $request->all();
			try{
                DB::insert('insert into customer_carts
                ( product_id, outlet_id, user_id, quantity, date)
                values (?, ?, ?, ?, ?)',
                array(
                      $data['productId'],
                      auth()->user()->outlet_id,
                      auth()->user()->id,
                      $data['quantity'],
                      date('Y-m-d')
                ));
               return 'success';
			}
			catch(Exception $e){
				return 'error';
			}
		}
    }



    protected function deleteCustomerAddSelesItem(Request $request){
        $data = $request->all();

        $id = $data['id'];

        $cart = DB::table('customer_carts')
        ->join('products', 'customer_carts.product_id', '=', 'products.id')
        ->where('customer_carts.id', $id)
        ->select('customer_carts.id', 'customer_carts.product_id', 'customer_carts.quantity',  'products.price_per_unite', 'products.offer', 'products.offer_mrp', 'products.expire_date')
        ->first();



        $price = $cart->price_per_unite;
        if($cart->offer && $cart->expire_date >= date('Y-m-d')) $price = $cart->offer_mrp;

        $quantity = $cart->quantity;

        $total_price = ($price * $quantity);

        DB::table('customer_carts')->where('id', $id)->delete();

        $rows = $this->addCustomerSelesForm($request);

        return response()->json([
            'price' => $total_price,
            'rows' => $rows,
        ]);
    }

    protected function addCustomerSeles(Request $request){


        $data = $request->all();
        $outlet = Outlet::where('id', auth()->user()->outlet_id)->first();

        $invoiceNo = Invoice::max('invoice_no');
        if($invoiceNo == null ){$invoiceNo = 1000;}

        $customerId = null;

        if(isset($request->customer_id) && !isset($request->new_customer)){
            $customerId = $request->customer_id;
        }
        else if(isset($request->new_customer)){
            if($request->name == null){
                return redirect()->back()->withErrors('name','Name is required');
            }
            else if($request->contact_no == null){
                return redirect()->back()->withErrors('contact_no','Contact Number is required');
            }
            else{
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->contact_no = $request->contact_no;
                $customer->outlet_id = auth()->user()->outlet_id;
                $customer->save();
                $customerId = $customer->id;
            }
        }




        $Carts =  DB::table('customer_carts')
        ->join('products', 'products.id', '=', 'customer_carts.product_id')
        ->where('customer_carts.outlet_id', auth()->user()->outlet_id)
        ->select(
            'customer_carts.id',
            'customer_carts.product_id',
            'customer_carts.outlet_id',
            'customer_carts.quantity',
            'products.name',
            'products.unit',
            'products.price_per_unite',
            'products.offer',
            'products.offer_mrp',
            'products.expire_date',
        )
        ->get();

        if($customerId != null){
            $request->contact_no = null;
            $request->name = null;
        }

        if($Carts->count()>0){
            $carts = [];
            $carte = [];
            $tf = true;

            $invoice = new Invoice;

            foreach($Carts as $cart){
                $product = Inventory::where('product_id', $cart->product_id)
                        ->where('outlet_id', auth()->user()->outlet_id)
                        ->first();

                if($product->quantity >= $cart->quantity){

                    if($tf){
                        $paid = $request->paid;
                        $change = $request->change;

                        if($paid == null){$paid = 0;}
                        if($change == null){$change = 0;}
                        $paid -= $change;

                        $invoice->invoice_no = (int)$invoiceNo+1;
                        $invoice->outlet_id = auth()->user()->outlet_id;
                        $invoice->total = $request->total;
                        $invoice->paid = $paid;

                        $invoice->save();
                        $tf = false;
                    }

                    DB::table('customer_seles')->insert([

                    'product_id' =>  $cart->product_id,
                    'outlet_id' =>  $cart->outlet_id,
                    'customer_id' => $customerId,
                    'unit' => $cart->unit,
                    'price_per_unite' =>  ($cart->offer && $cart->expire_date >= date('Y-m-d')) ? $cart->offer_mrp : $cart->price_per_unite,
                    'quantity' =>  $cart->quantity,
                    'total' =>  ((($cart->offer && $cart->expire_date >= date('Y-m-d')) ? $cart->offer_mrp : $cart->price_per_unite) * $cart->quantity),
                    'sales_no' => $invoice->id,
                    'date'=> date('Y-m-d'),
                    ]);



                    $product->quantity -= $cart->quantity;
                    $product->update();

                    $mainProduct = Product::where('id', $cart->product_id)->first();
                    $mainProduct->quantity -= $cart->quantity;
                    $mainProduct->update();
                    array_push($carts, $cart);
                }
                else{
                    array_push($carte, $cart);
                }
                DB::table('customer_carts')->where('id', $cart->id)->delete();
            }



            if($customerId){
                $account = CustomerAccount::where('customer_id', $customerId)
                ->where('outlet_id',auth()->user()->outlet_id)->first();

                if($account){
                    $account->due += $request->due;
                    $account->update();
                }else{
                    $account = new CustomerAccount;
                    $account->customer_id = $customerId;
                    $account->outlet_id = auth()->user()->outlet_id;
                    $account->due = $request->due;
                    $account->save();
                }
            }

        }
        else{
            return redirect()->route('add_sales_for_customer')->with('failed',"operation failed");
        }




        session()->put('carte', $carte);
        $invoiceId = $invoice->id;
        return redirect()->route('get_invoice_view',compact('invoiceId'));
    }

    protected function salesList(){

        $data = [
            'outlet' => 'all',
            'employe_customer' => 'all',
            'employe_id' => 'all',
            'customer_id' => 'all',
            'from_date' => '2022-01-01',
            'to_date' => date('Y-m-d'),
        ];

        if(auth()->user()->user_role == "outlet user"){
            $data['outlet'] = auth()->user()->outlet_id;
        }

        $sales = Seles::join('outlets', 'seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'seles.product_id', '=', 'products.id')
        ->join('employes', 'seles.employe_id', '=', 'employes.id')
        ->join('invoices', 'seles.sales_no', '=', 'invoices.id')
        ->where('seles.is_deleted', 0)
        ->select('seles.id',

            'seles.unit',
            'seles.price_per_unite',
            'seles.quantity',
            'seles.date',
            'invoices.invoice_no as sales_no',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'employes.id_card_number',
            'employes.contact_number',
            'seles.employe_id',
            'employes.name as employe_name',
            )
        ->get();

        $customerSales = DB::table('customer_seles')->join('outlets', 'customer_seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'customer_seles.product_id', '=', 'products.id')
        ->join('customers', 'customer_seles.customer_id', '=', 'customers.id')
        ->join('invoices', 'customer_seles.sales_no', '=', 'invoices.id')
        ->where('customer_seles.is_deleted', 0)
        ->select('customer_seles.id',
            'customer_seles.unit',
            'customer_seles.price_per_unite',
            'customer_seles.quantity',
            'customer_seles.date',
            'customer_seles.customer_id',
            'invoices.invoice_no as sales_no',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'customers.contact_no',
            'customers.name as customer_name',
            )
        ->get();

        $employes = Employe::where('is_deleted', 0)->get();
        $customers = Customer::where('is_deleted', 0)->get();

        $outlets = Outlet::get();
        return view('sales/salesList')->with(compact('outlets','sales','customerSales','data','employes', 'customers'));
    }





}
