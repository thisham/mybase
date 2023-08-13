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
}