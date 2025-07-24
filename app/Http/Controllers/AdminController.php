<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Afficher le tableau de bord admin
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
