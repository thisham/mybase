<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class LoanService extends Service
{
    public function getRegulation(): float
    {
        try {
            return DB::table('regulations')
                ->where('id', 'LOAN_FEE')
                ->first('rates')->rates;
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::getRegulation', $th);
            return 0;
        }
    }

    public function getLoanList(): Collection | array
    {
        try {
            $regulation =
                $this->getRegulation();

            return DB::table('loans')
                ->where('user_id', Auth::user()->id)
                ->get()->map(function ($data) use ($regulation) {
                    $billing = ($data->finalized_at) ? $data->billing :
                        ceil(($regulation / 100 * $data->value) / 10) * 10 + $data->value;

                    return (object) [
                        'id' => $data->id,
                        'account' => $data->account,
                        'value' => $data->value,
                        'billing' => $billing,
                        'rates' => $data->rates ?? $regulation,
                        'finalized_at' => $data->finalized_at
                    ];
                });
        } catch (\Throwable $th) {
            $this->writeLog('LoanService::getLoanList', $th);
            return [];
        }
    }

    public function storeLoan(object $data): bool
    {
        try {
            return DB::table('loans')->insert([
                'id' => Uuid::uuid4(),
                'user_id' => Auth::user()->id,
                'account' => $data->account,
                'value' => $data->value
            ]);
        } catch (\Throwable $th) {
            $this->writeLog('LoanService::storeLoan', $th);
            return false;
        }
    }
}