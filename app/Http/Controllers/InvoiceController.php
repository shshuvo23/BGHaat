<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\Employe;
use App\Models\Seles;
use App\Models\CoustomerSeles;
use App\Models\Cart;
use App\Models\CustomerCart;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    protected function invoiceMaker(Request $request){
        $carts = Session::get('carts');
        $employe = Session::get('employe');
        $outlet = Session::get('outlet');
        $serialNo = Session::get('invoice_serial');


        return view('layouts/invoice')->with(compact('carts','employe','outlet','serialNo'));

    }

    protected function invoiceView(){

       $invoices = Seles::distinct('sales_no')->pluck('sales_no');

        $data = [];
        foreach($invoices as $key => $invoice){
            $sel = Seles::join('employes', 'employes.id', '=', 'seles.employe_id')
            ->join('invoices', 'invoices.id', '=', 'seles.sales_no')
            ->where('sales_no', $invoice)
            ->where('invoices.outlet_id', auth()->user()->outlet_id)
            ->select('seles.id','seles.sales_no','seles.date', 'employes.name', 'employes.id_card_number', 'employes.contact_number','invoices.id as invoice_id', 'invoices.invoice_no')
            ->first();

            if($sel){
                $data[count($data)] = ([
                    'id' => $sel->id,
                    'sales_no' => $sel->sales_no,
                    'date' => $sel->date,
                    'employe_name' => $sel->name,
                    'employe_id' => $sel->id_card_number,
                    'contact_no' => $sel->contact_number,
                    'invoice_id' => $sel->invoice_id,
                    'invoice_no' => $sel->invoice_no,
                ]);
            }

        }

        $invoices = DB::table('customer_seles')->distinct('sales_no')->pluck('sales_no');
        foreach($invoices as $invoic){
            $sel = DB::table('customer_seles')
            ->join('invoices', 'invoices.id', '=', 'customer_seles.sales_no')
            ->leftJoin('customers','customer_seles.customer_id', '=', 'customers.id')
            ->where('sales_no', $invoic)
            ->where('invoices.outlet_id', auth()->user()->outlet_id)
            ->select('customer_seles.id','customer_seles.sales_no','customer_seles.date', 'invoices.id as invoice_id', 'invoices.invoice_no', 'customers.name as customer_name', 'customers.contact_no')
            ->first();
           if($sel){
                $data[count($data)] = ([
                    'id' => $sel->id,
                    'sales_no' => $sel->sales_no,
                    'date' => $sel->date,
                    'employe_name' => $sel->customer_name,
                    'employe_id' => $sel->contact_no,
                    'contact_no' => "",
                    'invoice_id' => $sel->invoice_id,
                    'invoice_no' => $sel->invoice_no,
                ]);
           }
        }

        // echo count($data);
        // echo '<pre>';
        // print_r($data);
        return view('sales/invoice', compact('data') );
    }



    protected function getInvoiceView(Request $request){
        $data = $request->all();
        $invoiceId = $data['invoiceId'];


        $carts = Seles::join('products', 'seles.product_id', '=', 'products.id')
        ->join('invoices', 'invoices.id', 'seles.sales_no')
        ->where('invoices.id', $invoiceId)
        ->select(

            'seles.price_per_unite',
            'seles.quantity',
            'seles.date',
            'products.name',
            'seles.outlet_id',
            'seles.employe_id',
            'seles.total',
            'invoices.invoice_no',
            'invoices.total as invoice_total',
            'invoices.paid',

        )
        ->get();
        //dd($carts);

        if(!($carts->count())){

            $carts = DB::table('customer_seles')
            ->join('products', 'customer_seles.product_id', '=', 'products.id')
            ->join('invoices', 'invoices.id', 'customer_seles.sales_no')
            ->where('invoices.id', $invoiceId)
            ->select(
                'customer_seles.customer_id',
                'customer_seles.price_per_unite',
                'customer_seles.quantity',
                'customer_seles.date',
                'products.name',
                'customer_seles.outlet_id',
                'customer_seles.total',
                'invoices.invoice_no',
                'invoices.total as invoice_total',
                'invoices.paid',

            )
            ->get();

                //return $carts;

            if(!($carts->count())){
                return 'No Invoice With This Serial Number';
            }else{


                $outlet_id = $carts[0]->outlet_id;


                //$employe = DB::table('customers')->where('id', $customer_id)->first();
                $outlet = Outlet::where('id', $outlet_id)->first();



                if(auth()->user()->user_role != 'Admin' && auth()->user()->outlet_id != $outlet_id){
                    return 'No Invoice With This Serial Number';
                }else{
                    $employe = new Employe;

                    if($carts[0]->customer_id != null){
                        $customer = Customer::where('id', $carts[0]->customer_id)->first();
                        $employe->name = $customer->name;
                        $employe->contact_number = $customer->contact_no;
                    }


                    return view('layouts/invoice')->with(compact('carts','employe','outlet'));
                }

            }
        }
        else{
            $outlet_id = $carts[0]->outlet_id;
            $employe_id = $carts[0]->employe_id;

            $employe = Employe::where('id', $employe_id)->first();
            $outlet = Outlet::where('id', $outlet_id)->first();

            if(auth()->user()->user_role != 'Admin' && auth()->user()->outlet_id != $outlet_id){
                return 'No Invoice With This Serial Number';
            }else{
                return view('layouts/invoice')->with(compact('carts','employe','outlet'));
            }
        }


    }
}
