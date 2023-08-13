<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanUpdaterController extends Controller
{
    private $service;

    public function __construct(LoanService $service)
    {
        $this->service = $service;
    }

    public function render(string $id)
    {
        return view('pages.loan-form', [
            'title' => __('display.financial.update-loans'),
            'action' => route('financial.update-loan', ['id' => $id]),
            'record' => $this->service->getLoanByID($id),
            'regulation' => $this->service->getRegulation(),
        ]);
    }

    public function handle(LoanRequest $request, string $id)
    {
        if ($this->service->updateLoan($request, $id))
            return redirect()->route('financial.loans')
                ->with('success', __('display.message.update-success'));

        return redirect()->back()->with(
            'error',
            __('display.message.update-failed')
        );
    }
}