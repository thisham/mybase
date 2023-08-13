<?php

namespace App\Services;

use Error;
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

    public function getLoanByID(string $id): object | null
    {
        try {
            $regulation = $this->getRegulation();
            $record = DB::table('loans')->where('id', $id)
                ->first([
                    'id', 'account', 'value', 'billing',
                    'rates', 'finalized_at', 'updated_at',
                    'created_at'
                ]);

            return (object) [
                'id' => $record->id,
                'account' => $record->account,
                'value' => $record->value,
                'reduction' => $regulation,
                'rates' => $record->rates ?? $regulation,
                'finalized_at' => $record->finalized_at,
                'updated_at' => $record->updated_at,
                'created_at' => $record->created_at
            ];
        } catch (\Throwable $th) {
            $this->writeLog('LoanService::getLoanByID', $th);
            return null;
        }
    }

    private function hasFinalized(string $id): bool
    {
        return DB::table('loans')
            ->where('id', $id)
            ->whereNotNull('finalized_at')
            ->exists();
    }

    public function updateLoan(object $data, string $id): bool
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            return DB::table('loans')
                ->where('id', $id)
                ->update([
                    'account' => $data->account,
                    'value' => $data->value
                ]);
        } catch (\Throwable $th) {
            $this->writeLog('LoanService::updateLoan', $th);
            return false;
        }
    }

    public function deleteByID(string $id): bool
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            return DB::table('loans')->where('id', $id)
                ->delete();
        } catch (\Throwable $th) {
            $this->writeLog('LoanService::deleteByID', $th);
            return false;
        }
    }
}