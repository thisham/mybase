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

    public function destroy(string $id)
    {
        if ($this->service->deleteByID($id))
            return redirect()->back()
                ->with('success', __('display.message.delete-success'));

        return redirect()->back()
            ->with('error', __('display.message.delete-failed'));
    }
}