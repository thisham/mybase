<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanCreatorController extends Controller
{
    private $service;

    public function __construct(LoanService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.loan-form', [
            'title' => __('display.financial.create-loans'),
            'action' => route('financial.create-loan'),
            'regulation' => $this->service->getRegulation(),
        ]);
    }

    public function handle(LoanRequest $request)
    {
        if ($this->service->storeLoan($request))
            return redirect()->route('financial.loans')
                ->with('success', __('display.message.create-success'));

        return redirect()->back()->with(
            'error',
            __('display.message.create-failed')
        );
    }
}