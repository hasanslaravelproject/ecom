<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;

class CompanyCustomersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Company $company)
    {
        $this->authorize('view', $company);

        $search = $request->get('search', '');

        $customers = $company
            ->customers()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerCollection($customers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'passcode' => ['required', 'max:255', 'string'],
        ]);

        $customer = $company->customers()->create($validated);

        return new CustomerResource($customer);
    }
}
