<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        return view('profile.show', [
            'name'  => $user->name,
            'email' => $user->email,
            'nis'   => $user->nis,
        ]);
    }
    
}
