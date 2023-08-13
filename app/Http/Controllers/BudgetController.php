<?php

namespace App\Http\Controllers;

use App\Services\BudgetService;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private $service;

    public function __construct(BudgetService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.budget', [
            'budgetList' => $this->service->getBudgetList(),
        ]);
    }

    public function destroy(string $id)
    {
        if ($this->service->deleteByID($id))
            return redirect()->back()
                ->with('success', __('display.message.delete-success'));

        return redirect()->back()
            ->with('error', __('display.message.delete-failed'));
    }
}
