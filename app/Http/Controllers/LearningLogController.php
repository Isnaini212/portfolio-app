<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LearningLogController extends Controller
{
    /**
     * Redirect public /logs route to the DevLog section on the single-page home layout.
     */
    public function index(): RedirectResponse
    {
        return redirect()->to(route('home') . '#devlog-preview');
    }
}
