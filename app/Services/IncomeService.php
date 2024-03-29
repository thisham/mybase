<?php

namespace App\Services;

use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class IncomeService extends Service
{
    public function getRegulation(): float
    {
        try {
            return DB::table('regulations')
                ->where('id', 'INCOME_REDUCTION')
                ->first('rates')->rates;
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::getRegulation', $th);
            return 0;
        }
    }

    public function getIncomeList(): Collection | array
    {
        try {
            $regulation = $this->getRegulation();

            return DB::table('incomes')
                ->where('user_id', Auth::user()->id)
                ->select([
                    'id', 'source', 'value', 'reduction', 'rates',
                    'finalized_at'
                ])->get()->map(function ($data) use ($regulation) {
                    $reduction = ($data->finalized_at) ? $data->reduction :
                        ceil(($regulation / 100 * $data->value) / 10) * 10;

                    return (object) [
                        'id' => $data->id,
                        'source' => $data->source,
                        'value' => $data->value,
                        'reduction' => $reduction,
                        'rates' => $data->rates ?? $regulation,
                        'finalized_at' => $data->finalized_at
                    ];
                });
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::getIncomeList', $th);
            return [];
        }
    }

    public function storeIncome(object $data): bool
    {
        try {
            return DB::table('incomes')->insert([
                'id' => Uuid::uuid4(),
                'user_id' => Auth::user()->id,
                'source' => $data->source,
                'value' => $data->value
            ]);
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::storeIncome', $th);
            return false;
        }
    }

    public function getIncomeByID(string $id): object | null
    {
        try {
            $regulation = $this->getRegulation();
            $record = DB::table('incomes')->where('id', $id)
                ->first([
                    'id', 'source', 'value', 'reduction',
                    'rates', 'finalized_at', 'updated_at',
                    'created_at'
                ]);

            return (object) [
                'id' => $record->id,
                'source' => $record->source,
                'value' => $record->value,
                'reduction' => $regulation,
                'rates' => $record->rates ?? $regulation,
                'finalized_at' => $record->finalized_at,
                'updated_at' => $record->updated_at,
                'created_at' => $record->created_at
            ];
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::getIncomeByID', $th);
            return null;
        }
    }

    private function hasFinalized(string $id): bool
    {
        return DB::table('incomes')
            ->where('id', $id)
            ->whereNotNull('finalized_at')
            ->exists();
    }

    public function updateIncome(object $data, string $id): bool
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            return DB::table('incomes')
                ->where('id', $id)
                ->update([
                    'source' => $data->source,
                    'value' => $data->value
                ]);
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::updateIncome', $th);
            return false;
        }
    }

    public function deleteByID(string $id): bool
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            return DB::table('incomes')->where('id', $id)
                ->delete();
        } catch (\Throwable $th) {
            $this->writeLog('IncomeService::deleteByID', $th);
            return false;
        }
    }
}