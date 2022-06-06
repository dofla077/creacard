<?php

namespace App\Http\Controllers;

use App\Contracts\CustomersService;
use App\Contracts\QuotationsService;
use App\Http\Requests\CreateCustomerRequest;

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
        list($customers, $columns) = $this->customerService->getCustomers();

        return view('customer.index', compact('customers', 'columns'));
    }

    /**
     * @param CreateCustomerRequest $request
     * @return mixed
     */
    public function create(CreateCustomerRequest $request)
    {
        return $this->customerService->create($request->validated());
    }

    public function add()
    {
        return view('customer.create');
    }
}
