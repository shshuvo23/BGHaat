<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerAccount;
use App\Models\EmployeAccount;
use App\Models\EmployePayment;
use App\Models\CustomerPayment;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    protected function dueAdjustment(){

       $customerAccounts = CustomerAccount::join('customers', 'customers.id', 'customer_accounts.customer_id')
        ->where('customer_accounts.outlet_id', auth()->user()->outlet_id)
        ->select('customer_accounts.id','customer_accounts.customer_id','customer_accounts.due','customers.id','customers.name','customers.contact_no',)
        ->get();

        // $employeAccounts = new EmployeAccount;
        // if(auth()->user()->user_role == "Admin"){
             $employeAccounts = EmployeAccount::join('employes', 'employes.id', 'employe_accounts.employe_id')
            ->where('employe_accounts.outlet_id', auth()->user()->outlet_id)
            ->select('employe_accounts.id','employe_accounts.employe_id','employe_accounts.due','employes.id','employes.name','employes.contact_number',)
            ->get();
        // }
       return view('account.dueList')->with(compact('customerAccounts','employeAccounts'));

    }

    protected function collectPayment(Request $request, $type, $id){



        if($type == 'employe'){
            $customer = EmployeAccount::join('employes', 'employe_accounts.employe_id', '=', 'employes.id')
            ->where('employe_accounts.outlet_id', auth()->user()->outlet_id)->where('employe_accounts.employe_id', $id)
            ->select('employes.name', 'employe_accounts.due', 'employe_accounts.employe_id as id')
            ->first();
            if( $customer) return view('account/collectDue')->with(compact('customer','type'));
        }
        else if($type == 'customer'){
            $customer = CustomerAccount::join('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->where('customer_accounts.outlet_id', auth()->user()->outlet_id)->where('customer_accounts.customer_id', $id)
            ->select('customers.name', 'customer_accounts.due', 'customer_accounts.customer_id as id')
            ->first();
            if( $customer)return view('account/collectDue')->with(compact('customer','type'));
        }
        return abort(404);
    }

    protected function paiedDue(Request $request){
        $roles = [
            'type' => 'required|in:customer,employe',
            'id' => 'required|numeric',
            'due' => 'required|numeric',
            'paid' => 'required|numeric',
            'change' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(),$roles);
		if ($validator->fails()) {
			return redirect()->route('collect_payment',[$request->type,$request->id])
			->withInput()
			->withErrors($validator);
		}
		else{

            $data = $request->all();
            if($data['paid'] > $data['due']){
                $data['paid'] = $data['due'];
            }

            if($data['type'] == 'employe'){
                $due = EmployeAccount::where('employe_id', $data['id'])
                ->where('outlet_id', auth()->user()->outlet_id)->first();
                $due->due -= $data['paid'];
                $due->update();
                $employePayments = new EmployePayment;
                $employePayments->employe_id = $data['id'];
                $employePayments->outlet_id = auth()->user()->outlet_id;
                $employePayments->amount = $data['paid'];
                $employePayments->save();
            }
            else if($data['type'] == 'customer'){
                $due = CustomerAccount::where('customer_id', $data['id'])
                ->where('outlet_id', auth()->user()->outlet_id)->first();
                $due->due -= $data['paid'];
                $due->update();
                $customerePayments = new CustomerPayment;
                $customerePayments->customer_id = $data['id'];
                $customerePayments->outlet_id = auth()->user()->outlet_id;
                $customerePayments->amount = $data['paid'];
                $customerePayments->save();
            }
            return redirect()->route('collect_payment',[$request->type,$request->id])->with('status',"Payment successfully");
        }
    }

    protected function paymentHistory(){

        $employePayment = EmployePayment::join('employes', 'employe_payments.employe_id', '=', 'employes.id')
        ->where('employe_payments.outlet_id', auth()->user()->outlet_id)
        ->select('employe_payments.id', 'employes.name', 'employes.contact_number', 'employe_payments.amount','employe_payments.created_at')
        ->get();


        $customerPayment = CustomerPayment::join('customers', 'customer_payments.customer_id', '=', 'customers.id')
        ->where('customer_payments.outlet_id', auth()->user()->outlet)
        ->select('customer_payments.id', 'customers.name', 'customers.contact_no', 'customer_payments.amount', 'customer_payments.created_at')
        ->get();

        return view('account/paymentList')->with(compact('employePayment','customerPayment'));
    }
}
