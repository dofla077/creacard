<?php

namespace App\Http\Middleware;

use App\Services\QuotationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class State
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs('quotations.customer.choice')
            && ($request->route('quotation')->isAccept() || $request->route('quotation')->isReject())) {
            return new Response(view('quotation.return', ["answer" => QuotationService::ANSWER_ALREADY]));
        }

        return $next($request);
    }
}
