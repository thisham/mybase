<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AuthenticationService extends Service
{
    public function attemptSignIn(object $data): bool
    {
        return Auth::attempt([
            'email' => $data->email,
            'password' => $data->password
        ]);
    }

    public function storeUser(object $data): bool
    {
        try {
            return DB::table('users')->insert([
                'id' => Uuid::uuid4(),
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password)
            ]);
        } catch (\Throwable $th) {
            $this->writeLog('AuthenticationService::storeUser', $th);
            return false;
        }
    }
}
