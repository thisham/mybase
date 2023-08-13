<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomeRequest;
use App\Services\IncomeService;
use Illuminate\Http\Request;

class UpdateIncomeController extends Controller
{
    private $service;

    public function __construct(IncomeService $service)
    {
        $this->service = $service;
    }

    public function render(string $id)
    {
        return view('pages.income-form', [
            'title' => __('display.financial.update-income'),
            'action' => route('financial.update-income', ['id' => $id]),
            'record' => $this->service->getIncomeByID($id),
            'regulation' => $this->service->getRegulation(),
        ]);
    }

    public function handle(IncomeRequest $request, string $id)
    {
        if ($this->service->updateIncome($request, $id))
            return redirect()->route('financial.incomes')
                ->with('success', __('display.message.update-success'));

        return redirect()->back()->with(
            'error',
            __('display.message.update-failed')
        );
    }
}