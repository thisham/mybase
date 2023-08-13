<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Services\IncomeService;
use Illuminate\Http\Request;

class CreateIncomeController extends Controller
{
    private $service;

    public function __construct(IncomeService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.income-form', [
            'feature' => 'create',
            'regulation' => $this->service->getRegulation()
        ]);
    }

    public function handle(IncomeRequest $request)
    {
        if ($this->service->storeIncome($request))
            return redirect()->route('financial.incomes')
                ->with('success', __('display.message.create-success'));

        return redirect()->back()->with(
            'error',
            __('display.message.create-failed')
        );
    }
}