<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use App\Models\Outlet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('isAdmin');
    }
	protected function addExpenseView(){
		$outlets = Outlet::where('outlets.is_deleted', 0)->get();
		return view('admin/expense/addExpense')->with(compact('outlets'));
	}
    protected function addExpense(Request $request){
        $rules = [
			'expense_title' => 'required|string|min:3|max:255',
            'expense_amount' => 'required|numeric',
            'outlet_id' => 'required',
            'expense_date' => 'required|date',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_expense_view')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$expense = new Expense;
                $expense->title = $data['expense_title'];
                $expense->description = $data['expense_description'];
                $expense->amount = $data['expense_amount'];
                $expense->outlet_id = $data['outlet_id'];
                $expense->user_id = auth()->user()->id;
                $expense->date = $data['expense_date'];
				$expense->save();
				return redirect('add_expense_view')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('add_expense_view')->with('failed',"operation failed");
			}
		}
    }

	protected function expenseList(){

        $users = User::join('outlets', 'users.outlet_id', '=', 'outlets.id')
        ->where('users.is_deleted', 0)
        // ->where('users.user_role', 'outlet user')
		->select('users.id as user_id', 'users.name as user_name', 'outlets.name as outlate_name', 'outlets.address')
		->get();

        $expenses = Expense::join('outlets', 'outlets.id', '=', 'expenses.outlet_id')
        ->where('expenses.is_deleted', 0)
        ->select(
            'expenses.id',
            'expenses.title',
            'expenses.description',
            'expenses.amount',
            'expenses.date',
            'expenses.outlet_id',
            'outlets.name as outlet_name',
        )
        ->get();


		// $expenses = Expense::join('users', 'users.id', '=', 'expenses.user_id')
        // ->join('users', 'outlets.id', '=', 'users.outlet_id')
        // ->where('expenses.is_deleted', 0)
        // ->select(
        //     'expenses.id',
        //     'expenses.title',
        //     'expenses.description',
        //     'expenses.amount',
        //     'expenses.date',
        //     'expenses.user_id',
        //     'users.name',
        //     'outlets.name as outlet_name',
        // )
        // ->get();
        return view('admin/expense/expenseList')->with(compact('expenses', 'users'));
	}


    protected function updateExpense(Request $request){
        $rules = [
			'expense_title' => 'required|string|min:3|max:255',
            'expense_amount' => 'required|numeric',
            'user_id' => 'required',
            'expense_date' => 'required|date',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_expense_view')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$expense = Expense::where('id', $data['id'])->first();
                $expense->title = $data['expense_title'];
                $expense->description = $data['expense_description'];
                $expense->amount = $data['expense_amount'];
                $expense->user_id = $data['user_id'];
                $expense->date = $data['expense_date'];
				$expense->update();
				return redirect('expense_list')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('expense_list')->with('failed',"operation failed");
			}
		}
    }
}
