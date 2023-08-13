<?php

namespace App\Http\Controllers;

use App\Services\IncomeService;
use Illuminate\Http\Request;

class UpdateIncomeController extends Controller
{
    private $service;

    public function __construct(IncomeService $service)
    {
        $this->service = $service;
    }

    public function render(Request $request, string $id)
    {
        return view('pages.income-form', [
            'title' => __('display.financial.update-income'),
            'action' => route('financial.update-income', ['id' => $id]),
            'record' => $this->service->getIncomeByID($id),
            'regulation' => $this->service->getRegulation(),
        ]);
    }
}