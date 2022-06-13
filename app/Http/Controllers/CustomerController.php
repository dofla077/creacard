<?php

namespace App\Http\Controllers;

use App\Contracts\CustomersService;
use App\Http\Requests\Customer\PostCustomerRequest;

class CustomerController extends Controller
{
    protected CustomersService $customerService;

    /**
     * @param CustomersService $customerService
     */
    public function __construct(CustomersService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Index customers
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $customers = $this->customerService->getCustomers();
        $columns = $this->customerService->getColumns();

        return view('customer.index', compact('customers', 'columns'));
    }

    /**
     * @param PostCustomerRequest $request
     * @return mixed
     */
    public function store(PostCustomerRequest $request)
    {
        return $this->customerService->create($request->validated());
    }

    public function create()
    {
        return view('customer.create');
    }
}
