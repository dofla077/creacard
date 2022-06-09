<?php

namespace App\Http\Controllers;

use App\Contracts\QuotationsService;
use App\Enums\QuotationState;
use App\Http\Requests\Quotation\PostQuotationRequest;
use App\Http\Requests\Quotation\PutQuotationRequest;
use App\Models\Quotation;
use Illuminate\Http\Response;

class QuotationController extends Controller
{
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
        $quotations = $this->quotationService->getQuotations();
        $columns = $this->quotationService->getColumns();
        $states = QuotationState::cases();

        return view('quotation.index', compact('quotations', 'columns', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(PostQuotationRequest $request)
    {
        return $this->quotationService->create($request->validated());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $customers = $this->quotationService->getComponents();

        return view('quotation.create', compact('customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Quotation $quotation)
    {
        $customers = $this->quotationService->getComponents();

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
}
