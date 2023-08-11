<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $service;

    public function __construct(DashboardService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        $userID = Auth::user()->id;

        return view('pages.dashboard', [
            'currentBalance' => $this->service->getLatestBalance($userID),
            'currentBilling' => $this->service->getCurrentBillings($userID),
            'currentLoans' => $this->service->getCurrentLoans($userID),
            'billingPrediction' => $this->service->getBillingPrediction($userID)
        ]);
    }
}
