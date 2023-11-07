<?php

namespace App\Http\Controllers;

use App\Events\SendEmailsEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(10);

        return Inertia::render('Company/Listing', compact('companies'));
    }

    public function create()
    {
        return Inertia::render('Company/Add');
    }

    public function store(Request $request)
    {
        $validator = $this->validateForm($request);

        if ($validator->fails()) {
            return Inertia::render('Company/Add',[
                'errors'=>$validator->errors(),
                'formData'=>$request->all(),
            ])->with('error','Company Not Created');
        }
        $form_data=$request->all();

        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            $filename = $uploadedFile->getClientOriginalName();
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename=md5($filename.Carbon::now()).'.'.$extension;
            $uploadedFile->storeAs('public/logos',$filename );
            $form_data['logo'] = $filename;
        }

        $company_data=Company::create($form_data);

        /*Sending Email Notification*/
        if($request->email){
            event(new SendEmailsEvent($company_data,'Company'));
        }

        return redirect()->route('companies.index')->with('message',$this->returnMessages('success','Company Created Successfully'));

    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        $company=Company::findOrFail($company->id);
        return Inertia::render('Company/Edit',compact('company'));
    }

    public function update(Request $request, Company $company)
    {

        $validator = $this->validateForm($request);
        $formData=$request->all();
        if ($validator->fails()) {
            return Inertia::render('Company/Edit',[
                'errors'=>$validator->errors(),
                'formData'=>$formData,
            ])->with('error','Company Not Updated');
        }
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            $filename = $uploadedFile->getClientOriginalName();
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename=md5($filename.Carbon::now()).'.'.$extension;
            $uploadedFile->storeAs('public/logos',$filename );
            $formData['logo'] = $filename;
        }

        $company->update($formData);
        return redirect()->route('companies.index')->with('message',$this->returnMessages('success','Company Updated Successfully'));
    }
    public function returnMessages($type,$message){
        return [
            'type'=>$type,
            'message'=>$message,
        ];
    }
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('message',$this->returnMessages('success','Company Deleted Successfully'));
    }

    public function validateForm($request){
        $rules=[
            'name' => 'required',
        ];
        if ($request->hasFile('logo')) {
            $rules['logo']='image|mimes:jpeg,png,jpg,gif|dimensions:min_width=100,min_height=100';
        }
        return Validator::make($request->all(),$rules);
    }
}
