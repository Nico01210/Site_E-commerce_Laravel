<?php

namespace App\Http\Controllers;

use App\Models\User;

class AddressController extends Controller
{
    public function index($id)
    {
        $user = User::with('addresses')->findOrFail($id);

        return view('addresses.index', compact('user'));
    }
}