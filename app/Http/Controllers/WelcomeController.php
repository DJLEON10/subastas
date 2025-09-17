<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class WelcomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('estado', '=', '1')->orderBy('titulo')->get();
        return view('welcome', compact('sliders'));
    }
}
