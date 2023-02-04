<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('isAdmin');
    }

	protected function addOutletView(){
		return view('admin/outlet/addOutletView');
	}
    protected function makeOutlet(Request $request)
    {
        $rules = [
			'name' => 'required|string|min:3|max:255',
			'address' => 'required|string|min:3|max:255',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('add_outlet_view')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$outlet = new Outlet;
                $outlet->name = $data['name'];
                $outlet->address = $data['address'];
				$outlet->mode = 'public';
				$outlet->save();
				return redirect('add_outlet_view')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('add_outlet_view')->with('failed',"operation failed");
			}
		}
    }

    protected function outletList()
    {
        $outlets = Outlet::where('is_deleted', 0)->get();
        return view('admin/outlet/outletList')->with(compact('outlets'));
    }

	protected function updateOutlet(Request $request){
		$rules = [
			'name' => 'required|string|min:3|max:255',
			'address' => 'required|string|min:3|max:255',
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect()->route('outlet_list')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
				$outlet = Outlet::find($data['id']);
                $outlet->name = $data['name'];
                $outlet->address = $data['address'];
				$outlet->update();
				return redirect()->route('outlet_list')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->route('outlet_list')->with('failed',"operation failed");
			}
		}
	}

    protected function deleteOutlet(Request $request){

        $data = $request->all();
        $id = $data['id'];
        try{
            $outlet = Outlet::find($id);
            $outlet->is_deleted = 1;
            $outlet->update();

            return redirect()->route('outlet_list')
			->withInput();
        }catch(Exception $e){
            return "Not Delete";
        }
    }
}
