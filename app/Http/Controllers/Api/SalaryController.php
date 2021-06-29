<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function allSalary(Request $request){
        $salaries = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

        return response()->json($salaries);
    }
    
    public function salaryPay(Request $request, $id)
    {
        $validateData = $request->validate([
            'salary_month' => 'required',
            'amount' => 'required'
        ]);

        $month = $request->salary_month;
        $year = date('Y');
        $check = Salary::where('employee_id', $id)->where('salary_month', $month)
        ->where('salary_year', $year)->first();

        if($check){
            return response()->json('Employee Salary Already Paid');
        }
        else{
            $salary = new Salary();
            $salary->employee_id = $id;
            $salary->amount = $request->salary;
            $salary->salary_date = date('d/m/Y');
            $salary->salary_month = date('F');
            $salary->salary_year = date('Y');

            $salary->save();
        }
    }

    public function viewSalary($id){
        $salaries = DB::table('salaries')
        ->join('employees', 'employees.id', 'salaries.employee_id')
        ->select('salaries.*', 'employees.name')
        ->where('salary_month',$id)
        ->get();

        return response()->json($salaries);
    }

    public function editSalary($id){

        $salaries = DB::table('salaries')
        ->join('employees', 'employees.id', 'salaries.employee_id')
        ->select('salaries.*', 'employees.name', 'employees.email')
        ->where('salaries.id',$id)
        ->first();

        return response()->json($salaries);
    }

    public function updateSalary(Request $request, $id)
    {

        $salary = Salary::findOrFail($id);
        $salary->employee_id = $request->employee_id;
        $salary->amount = $request->amount;
        $salary->salary_month = $request->salary_month;

        $salary->update();
    }

}
