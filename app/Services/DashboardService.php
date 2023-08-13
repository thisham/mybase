<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService extends Service
{
    public function getLatestBalance(string $userID)
    {
        try {
            return DB::table('payments')->select('balance')
                ->orderBy('created_at', 'desc')
                ->where('user_id', $userID)
                ->first()->balance;
        } catch (\Throwable $th) {
            $this->writeLog('DashboardService::getLatestBalance', $th);
            return 0;
        }
    }

    public function getCurrentBillings(string $userID): float
    {
        try {
            return DB::table('invoices')->selectRaw(DB::raw('sum(rest) as balance'))
                ->where('user_id', $userID)
                ->whereNull('paid_at')
                ->first()->balance;
        } catch (\Throwable $th) {
            $this->writeLog('DashboardService::getCurrentBillings', $th);
            return 0;
        }
    }

    public function getCurrentLoans(string $userID): float
    {
        try {
            $rates = (float) DB::table('regulations')->select('rates')
                ->where('id', 'LOAN_FEE')->first()->rates;
            $balance = (float) DB::table('loans')->selectRaw(DB::raw('sum(value) as balance'))
                ->where('user_id', $userID)
                ->whereNull('finalized_at')
                ->first()->balance;
            return ceil(($balance + ($balance * $rates / 100)) / 10) * 10;
        } catch (\Throwable $th) {
            $this->writeLog('DashboardService::getCurrentLoans', $th);
            return 0;
        }
    }

    public function getBillingPrediction(string $userID): float
    {
        try {
            $rates = (float) DB::table('regulations')->select('rates')
                ->where('id', 'INCOME_REDUCTION')->first()->rates;
            $incomeReductions = 0;
            $incomes = DB::table('incomes')->select('value')
                ->where('user_id', $userID)
                ->whereNull('finalized_at')
                ->get()->map(function ($data) use ($rates) {
                    return (object) [
                        'value' => ceil(($data->value * $rates / 100) / 10) * 10
                    ];
                });

            foreach ($incomes as $record) {
                $incomeReductions += $record->value;
            }

            return $this->getCurrentBillings($userID)
                + $this->getCurrentLoans($userID)
                + $incomeReductions;
        } catch (\Throwable $th) {
            $this->writeLog('DashboardService::getPredictedBillings', $th);
            return 0;
        }
    }
}
