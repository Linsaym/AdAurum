<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->json([
            'message' => 'Company created successfully.',
            'company' => $company,
        ], 201);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return response()->json($company);
    }

    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());

        return response()->json([
            'message' => 'Company updated successfully.',
            'company' => $company,
        ]);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json([
            'message' => 'Company deleted successfully.',
        ]);
    }
}
