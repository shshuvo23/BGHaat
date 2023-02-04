<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeController extends Controller
{



    protected function addEmpoyeView()
    {
        return view('admin/employe/addEmploye');
    }


    protected function addEmpoye(Request $request)
    {
        $rules = [
            'employe_name' => 'required|string|min:3|max:255',
            'designation' => 'nullable|string|min:3|max:255',
            'depertment' => 'required|string|min:2|max:255',
            'id_card_number' => 'required|string|min:2|max:255|unique:employes',
            'credit_limit' => 'required|numeric',
            'salary' => 'required|numeric',
            'contact_no' => 'nullable|string|min:11|max:14',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('add_employe_view')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $employe = new Employe;
                $employe->name = $data['employe_name'];
                $employe->designation = $data['designation'];
                $employe->depertment = $data['depertment'];
                $employe->id_card_number = $data['id_card_number'];
                $employe->salary = $data['salary'];
                $employe->credit_limit = $data['credit_limit'];
                $employe->contact_number = $data['contact_no'];
                $employe->save();
                return redirect('add_employe_view')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect('add_employe_view')->with('failed', "operation failed");
            }
        }
    }

    // view all employe list
    protected function employeList()
    {
        $employes = Employe::where('is_deleted', 0)->get();
        return view('admin/employe/employeList')->with(compact('employes'));
    }

    protected function getAllEmployeData()
    {
        $employes = Employe::where('is_deleted', 0)->get();
        return $employes;
    }


    protected function updateEmploye(Request $request)
    {
        // $data = $request->input();
        // return $data;
        $rules = [
            'id' => 'required',
            'name' => 'required|string|min:3|max:255',
            'designation' => 'nullable|string|min:3|max:255',
            'department' => 'required|string|min:2|max:255',
            'id_card_number' => 'required|string|min:2|max:255|unique:employes,id_card_number,' . $request->id,
            'salary' => 'required|numeric',
            'credit_limit' => 'required|numeric',
            'contact_number' => 'nullable|string|min:11|max:14',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            //  return $validator->errors();
            return redirect()->route('employe_list')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            // dd($data);

            try {
                $employe = Employe::find($data['id']);
                $employe->name = $data['name'];
                $employe->designation = $data['designation'];
                $employe->depertment = $data['department'];
                $employe->id_card_number = $data['id_card_number'];
                $employe->salary = $data['salary'];
                $employe->credit_limit = $data['credit_limit'];
                $employe->contact_number = $data['contact_number'];
                //return $employe;
                $employe->update();
                return redirect()->route('employe_list')->with('status', "Update successfully");
            } catch (Exception $e) {
                return redirect()->route('employe_list')->with('failed', "operation failed");
            }
        }
    }


    protected function deleteEmploye(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];
        try {
            $employe = Employe::find($id);
            $employe->is_deleted = 1;
            $employe->update();

            // return redirect()->route('employe_list')->withInput();
        } catch (Exception $e) {
            return "Not Delete";
        }
    }
}
