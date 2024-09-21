<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function company()
    {
        $company = Company::find(1);
        return view('company', compact('company'));
    }

    public function store(Request $request)
    {

        $company = Company::find(1);
        if ($request->hasFile('logo')) {
            $com_logo = $request->file('logo');
            $logoName = time() . '.' . $com_logo->getClientOriginalExtension();
            $com_logo->storeAs('public/companyLogo', $logoName);
            $company->logo = 'storage/companyLogo/' . $logoName;
        }


        $company->update($request->all());

        return redirect('company')->with('success', true);
    }

    public function getCompany()
    {
        $company = Company::find(1);
        return response()->json(['success' => true, 'message' => 'Data get successfully', 'data' => $company], 200);
    }
}
