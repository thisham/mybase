<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Services\BudgetService;
use Illuminate\Http\Request;

class BudgetCreatorController extends Controller
{
    private $service;

    public function __construct(BudgetService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.budget-form', [
            'title' => __('display.financial.create-budget'),
            'action' => route('financial.create-budget')
        ]);
    }

    public function handle(BudgetRequest $request)
    {
        if ($this->service->store($request))
            return redirect()->route('financial.budgets')
                ->with('success', __('display.message.create-success'));

        return redirect()->back()
            ->with('error', __('display.message.create-failed'));
    }
}
