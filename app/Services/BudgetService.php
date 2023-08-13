<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
}