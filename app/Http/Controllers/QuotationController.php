<?php

namespace App\Http\Controllers;

use App\Contracts\QuotationsService;
use App\Enums\QuotationState;
use App\Http\Requests\Quotation\PostQuotationRequest;
use App\Http\Requests\Quotation\PutQuotationRequest;
use App\Models\Quotation;
use App\Services\CustomerService;
use Illuminate\Http\Response;

class QuotationController extends Controller
{
    /**
     * @var QuotationsService
     */
    protected QuotationsService $quotationService;

    /**
     * @param QuotationsService $quotationService
     */
    public function __construct(QuotationsService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        list($quotations, $columns, $states, $na) = $this->quotationService->getIndexData();

        return view('quotation.index', compact('quotations', 'columns', 'states', 'na'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostQuotationRequest $request
     * @return Response
     */
    public function store(PostQuotationRequest $request)
    {
        return $this->quotationService->create($request->validated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CustomerService $customerService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(CustomerService $customerService)
    {
        $customers = $customerService->getCustomers(false);

        return view('quotation.create', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Quotation $quotation
     * @param CustomerService $customerService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Quotation $quotation, CustomerService $customerService)
    {
        $customers = $customerService->getCustomers(false);

        return view('quotation.edit', compact('quotation', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutQuotationRequest $request
     * @param Quotation $quotation
     * @return bool
     */
    public function update(PutQuotationRequest $request, Quotation $quotation)
    {
        return $this->quotationService->save($quotation, $request->except('id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Quotation $quotation
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function destroy(Quotation $quotation)
    {
        $this->quotationService->delete($quotation);

        return redirect()->back();
    }

    /**
     * Send
     *
     * @param Quotation $quotation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Quotation $quotation)
    {
        $this->quotationService->sendNotification($quotation->load('customer'));

        return redirect()->back();
    }

    /**
     * Customer choice
     *
     * @param Quotation $quotation
     * @param QuotationState $state
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function customerChoice(Quotation $quotation, QuotationState $state)
    {
        $choice = $this->quotationService->customerChoice($quotation->load('customer.user'), $state);

        return view('quotation.return', ['answer' => $choice]);
    }
}
