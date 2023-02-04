<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Employe;
use App\Models\Seles;
use App\Models\CoustomerSeles;
use App\Models\Cart;
use App\Models\CustomerCart;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generateSalesPDF(Request $request){
        $data = $request->all();
        // echo '<pre>';
        // print_r($data);
        // exit();

        if(auth()->user()->user_role == "outlate user"){
            $data['outlet'] = auth()->user()->outlet_id;
        }
        $sales = Seles::join('outlets', 'seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'seles.product_id', '=', 'products.id')
        ->join('employes', 'seles.employe_id', '=', 'employes.id')
        ->join('invoices', 'seles.sales_no', '=', 'invoices.id')
        ->where('seles.is_deleted', 0)
        ->select('seles.id',
            'seles.price_per_unite',
            'seles.quantity',
            'seles.unit',
            'seles.date',
            'seles.employe_id',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'employes.id_card_number',
            'employes.contact_number',
            'employes.name as employe_name',
            'invoices.invoice_no as sales_no',
            )
        ->get();

        $customerSales = DB::table('customer_seles')->join('outlets', 'customer_seles.outlet_id', '=', 'outlets.id')
        ->join('products', 'customer_seles.product_id', '=', 'products.id')
        ->join('customers', 'customer_seles.customer_id', '=', 'customers.id')
        ->join('invoices', 'customer_seles.sales_no', '=', 'invoices.id')
        ->where('customer_seles.is_deleted', 0)
        ->select('customer_seles.id',

            'customer_seles.price_per_unite',
            'customer_seles.quantity',
            'customer_seles.unit',
            'customer_seles.date',
            'products.name as product_name',
            'outlets.id as outlet_id',
            'outlets.name as outlet_name',
            'outlets.address',
            'customers.contact_no',
            'customers.name as customer_name',
            'invoices.invoice_no as sales_no',
            )
        ->get();


        $pdf = PDF::loadView('PDF/salesPdf',compact('sales','customerSales','data'));
        return $pdf->download('salesList.pdf');

    }

    protected function pdfHeader(){
        return view('PDF/PDFHeader');
    }

    protected function downloadExpensePdf(){
        $expenses = DB::table('expenses')
        ->join('users', 'users.id', '=', 'expenses.user_id')
        ->join('outlets', 'outlets.id', '=', 'users.outlet_id')
        ->where('expenses.is_deleted', 0)
        ->select(
            'expenses.id',
            'expenses.title',
            'expenses.description',
            'expenses.amount',
            'expenses.date',
            'expenses.user_id',
            'users.name',
            'outlets.name as outlet_name',
        )
        ->get();

        $pdf = PDF::loadView('PDF/expensePdf',compact('expenses'));
        return $pdf->download('expenseList.pdf');
    }

    protected function downloadPurchasePdf(){


        $purchases = Purchase::leftJoin('products', 'purchases.product_id', '=', 'products.id')
		->select('purchases.id', 'purchases.product_id', 'purchases.price', 'purchases.total', 'purchases.quantity', 'purchases.date', 'products.name')
		->where('purchases.is_deleted', 0)
        ->get();

        $pdf = PDF::loadView('PDF/purchasePdf',compact('purchases'));
        return $pdf->download('purchaseList.pdf');
    }
}
