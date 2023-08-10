<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    private $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('pages.sign-in');
    }

    public function handle(SignInRequest $request)
    {
        if ($this->service->attemptSignIn($request)) {
            $request->session()->regenerate();
            return redirect()->route('main.dashboard');
        }

        return redirect()->back()->withInput();
    }
}
