<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ApprovalController extends Controller
{
    /**
     * Show pending approval page.
     */
    public function pending(): View
    {
        return view('auth.pending-approval');
    }

    /**
     * Show rejection page.
     */
    public function rejected(): View
    {
        return view('auth.rejected-approval');
    }
}

