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

    public function destroy(string $id)
    {
        if ($this->service->deleteByID($id))
            return redirect()->back()
                ->with('success', __('display.message.delete-success'));

        return redirect()->back()
            ->with('error', __('display.message.delete-failed'));
    }
}