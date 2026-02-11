<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getOthrerUsers()
    {
        return \App\Models\User::where('id', '!=', Auth::id())->get();
    }
}