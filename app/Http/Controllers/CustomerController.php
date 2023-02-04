<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    protected function addCustomerView(){
        return view('customer/addCustomer');
    }

    protected function addCustomer(Request $request){
        $rules = [
			'customer_name' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255|unique:customers',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_customer_view')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$customer = new Customer;
                $customer->name = $data['customer_name'];
                $customer->contact_no = $data['contact_no'];
                $customer->address = $data['address'];
				$customer->save();
				return redirect('add_customer_view')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('add_customer_view')->with('failed',"operation failed");
			}
		}
    }

    protected function customerList(){
        $customers = Customer::where('is_deleted', 0)->get();
        return view('customer/customerList')->with(compact('customers'));
    }

    protected function updateCustomer(Request $request){
        $rules = [
			'customer_name' => 'required|string|min:3|max:255',
            'address' => 'required|string|min:3|max:255',
            'contact_no' => 'required|string|min:3|max:255',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->route('customer_list')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$customer = Customer::find($data['id']);
                $customer->name = $data['customer_name'];
                $customer->contact_no = $data['contact_no'];
                $customer->address = $data['address'];
				$customer->update();
				return redirect()->route('customer_list')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->route('customer_list')->with('failed',"operation failed");
			}
		}
    }

    protected function deleteCustomer(Request $request){

        $data = $request->all();
        $id = $data['id'];
        try{
            $customer = Customer::find($id);
            $customer->is_deleted = 1;
            $customer->update();

            return redirect()->route('customer_list')
			->withInput();
        }catch(Exception $e){
            return "Not Delete";
        }
    }

    protected function getAllCustomerData(){
        $customers = Customer::where('is_deleted', 0)->get();
        return $customers;
    }
}
