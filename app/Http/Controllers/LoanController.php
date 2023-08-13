<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    private $service;

    public function __construct(LoanService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.loan', [
            'loansList' => $this->service->getLoanList(),
        ]);
    }
}