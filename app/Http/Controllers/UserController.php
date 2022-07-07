<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }
}
