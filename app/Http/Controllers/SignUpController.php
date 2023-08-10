<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignUpRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    private $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.sign-up');
    }

    public function handle(SignUpRequest $request)
    {
        if (!$this->service->storeUser($request))
            return redirect()->back()->withInput();

        if (!$this->service->attemptSignIn($request))
            return redirect()->back()->withInput();

        $request->session()->regenerate();
        return redirect()->route('main.dashboard');
    }
}
