<?php

namespace App\Http\Controllers;

use App\Services\IncomeService;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    private $service;

    public function __construct(IncomeService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.income', [
            'incomeList' => $this->service->getIncomeList()
        ]);
    }
}