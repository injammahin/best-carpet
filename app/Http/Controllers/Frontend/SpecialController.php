<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SpecialPromo;
use Illuminate\View\View;

class SpecialController extends Controller
{
    public function index(): View
    {
        $promos = SpecialPromo::active()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('frontend.specials.index', compact('promos'));
    }
}