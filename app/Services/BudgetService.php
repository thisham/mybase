<?php

namespace App\Services;

use Error;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BudgetService extends Service
{
    public function getBudgetList(): Collection| array
    {
        try {
            return DB::table('budgets')
                ->where('user_id', Auth::user()->id)
                ->select([
                    'id', 'name', 'value', 'tax', 'admin',
                    'subtotal', 'billing', 'finalized_at'
                ])->get()->map(function ($data) {
                    $subtotal = ($data->finalized_at) ? $data->subtotal :
                        $data->value + $data->tax + $data->admin;
                    $billing = ($data->finalized_at) ? $data->billing :
                        ceil(($subtotal) / 10) * 10;

                    return (object) [
                        'id' => $data->id,
                        'name' => $data->name,
                        'value' => $data->value,
                        'tax' => $data->tax,
                        'admin' => $data->admin,
                        'subtotal' => $subtotal,
                        'billing' => $billing,
                        'finalized_at' => $data->finalized_at
                    ];
                });
        } catch (\Throwable $th) {
            $this->writeLog('BudgetService::getBudgetList', $th);
            return [];
        }
    }

    public function store(object $data): bool
    {
        try {
            $subtotal = $data->value + ($data->tax ?? 0) + ($data->admin ?? 0);
            $billing = ceil($subtotal / 10) * 10;

            return DB::table('budgets')->insert([
                'id' => Uuid::uuid4(),
                'user_id' => Auth::user()->id,
                'name' => $data->name,
                'value' => $data->value,
                'tax' => $data->tax,
                'admin' => $data->admin,
                'subtotal' => $subtotal,
                'billing' => $billing
            ]);
        } catch (\Throwable $th) {
            $this->writeLog('BudgetService::store', $th);
            return false;
        }
    }

    public function getByID(string $id): object | null
    {
        try {
            $record = DB::table('budgets')->where('id', $id)->first([
                'id', 'name', 'value', 'tax', 'admin',
                'subtotal', 'billing', 'finalized_at',
                'created_at', 'updated_at'
            ]);

            $subtotal = ($record->finalized_at) ? $record->subtotal :
                $record->value + $record->tax + $record->admin;
            $billing = ($record->finalized_at) ? $record->billing :
                ceil(($subtotal) / 10) * 10;

            return (object) [
                'id' => $record->id,
                'name' => $record->name,
                'value' => $record->value,
                'tax' => $record->tax,
                'admin' => $record->admin,
                'subtotal' => $subtotal,
                'billing' => $billing,
                'finalized_at' => $record->finalized_at,
                'created_at' => $record->created_at,
                'updated_at' => $record->updated_at
            ];
        } catch (\Throwable $th) {
            $this->writeLog('BudgetService::getByID', $th);
            return null;
        }
    }

    private function hasFinalized(string $id): bool
    {
        return DB::table('budgets')
            ->where('id', $id)
            ->whereNotNull('finalized_at')
            ->exists();
    }

    public function update(object $data, string $id): bool
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            $subtotal = $data->value + ($data->tax ?? 0) + ($data->admin ?? 0);
            $billing = ceil($subtotal / 10) * 10;

            return DB::table('budgets')
                ->where('id', $id)
                ->update([
                    'name' => $data->name,
                    'value' => $data->value,
                    'tax' => $data->tax,
                    'admin' => $data->admin,
                    'subtotal' => $subtotal,
                    'billing' => $billing
                ]);
        } catch (\Throwable $th) {
            $this->writeLog('BudgetService::update', $th);
            return false;
        }
    }

    public function deleteByID(string $id)
    {
        try {
            if ($this->hasFinalized($id))
                throw new Error('report.finalized');

            return DB::table('budgets')->where('id', $id)
                ->delete();
        } catch (\Throwable $th) {
            $this->writeLog('BudgetService::deleteByID', $th);
            return false;
        }
    }
}
