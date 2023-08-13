<?php

namespace App\Http\Controllers;

use App\Http\Requests\BudgetRequest;
use App\Services\BudgetService;
use Illuminate\Http\Request;

class BudgetUpdaterController extends Controller
{
    private $service;

    public function __construct(BudgetService $service)
    {
        $this->service = $service;
    }

    public function render(string $id)
    {
        return view('pages.budget-form', [
            'title' => __('display.financial.update-budget'),
            'action' => route('financial.update-budget', ['id' => $id]),
            'record' => $this->service->getByID($id),
        ]);
    }

    public function handle(BudgetRequest $request, string $id)
    {
        if ($this->service->update($request, $id))
            return redirect()->route('financial.budgets')
                ->with('success', __('display.message.update-success'));

        return redirect()->back()
            ->with('error', __('display.message.update-failed'));
    }
}
