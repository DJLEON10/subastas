<?php

namespace App\Http\Controllers;

use App\Models\Familiar;
use App\Models\Habitante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = Habitante::count();
        $totalf = Familiar::count();
        $totalu = User::where('rol', 1)->count();

        $contador1 = Habitante::where('comuna', 'comuna_1')->count();
        $contador2 = Habitante::where('comuna', 'comuna_2')->count();
        $contador3 = Habitante::where('comuna', 'comuna_3')->count();
        $contador4 = Habitante::where('comuna', 'comuna_4')->count();
        $contador5 = Habitante::where('comuna', 'comuna_5')->count();
        $contador6 = Habitante::where('comuna', 'comuna_6')->count();
    
        return view('home', compact(
            'contador1', 'contador2', 'contador3',
            'contador4', 'contador5', 'contador6','total','totalf','totalu'
        ));
    }


public function graficaHabitantes()
{
    $habitantesPorMes = DB::table('habitantes')
        ->selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');

    // Completa los meses vacíos con cero
    $datos = [];
    for ($i = 1; $i <= 12; $i++) {
        $datos[] = $habitantesPorMes->get($i, 0);
    }

    return view('habitantes.grafica', [
        'datos' => json_encode($datos)
    ]);
}

}
