<?php

namespace App\Http\Controllers;

use App\Events\SendEmailsEvent;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->orderBy('id','desc')->paginate(10);

        return Inertia::render('Employee/Listing', compact('employees'));
    }

    public function create()
    {
        $companies=Company::all();
        return Inertia::render('Employee/Add',compact('companies'));
    }

    public function store(Request $request)
    {
        $validator=$this->validateForm($request);
        $formData=$request->all();
        if ($validator->fails()) {
            $companies=Company::all();
            return Inertia::render('Employee/Add',[
                'errors'=>$validator->errors(),
                'formData'=>$formData,
                'companies'=>$companies,
            ])->with('error','Employee Not Added');
        }

        $employee_data=Employee::create($formData);

        /*Sending Email Notification*/
        if($request->email){
            event(new SendEmailsEvent($employee_data,'Employee'));
        }

        return redirect()->route('employees.index')->with('message',$this->returnMessages('success','Employee Created Successfully'));

    }

    public function show(Employee $employee)
    {
//        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies=Company::all();
        $employee=Employee::findOrFail($employee->id);
        return Inertia::render('Employee/Edit',compact('employee','companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validator=$this->validateForm($request);
        $formData=$request->all();

        if ($validator->fails()) {
            $companies=Company::all();
            return Inertia::render('Employee/Edit',[
                'errors'=>$validator->errors(),
                'formData'=>$formData,
                'companies'=>$companies,
            ])->with('error','Employee Not Updated');
        }
        $employee->update($formData);
        return redirect()->route('employees.index')->with('message',$this->returnMessages('success','Employee Updated Successfully'));
    }
    public function returnMessages($type,$message){
        return [
            'type'=>$type,
            'message'=>$message,
        ];
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('message',$this->returnMessages('success','Employee Deleted Successfully'));
    }

    public function validateForm($request){
        $rules=[
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        return $validator;
    }
}
