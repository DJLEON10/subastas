<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForoController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $query = Foro::query();

        if ($search !== '') {
            $query->whereRaw([
                '$or' => [
                    ['titulo' => ['$regex' => $search, '$options' => 'i']],
                    ['descripcion' => ['$regex' => $search, '$options' => 'i']],
                ]
            ]);
        }

        $foros = $query->paginate(10);

        return view('foros.index', compact('foros'));
    }

    public function create()
    {
        return view('foros.create');
    }

    public function store(Request $request)
    {
        Foro::create([
            'titulo'     => $request->titulo,
            'descripcion'=> $request->descripcion,
            'user_id'    => Auth::getUser()->_id,
            'mensajes'   => []
        ]);

        return redirect()->route('foros.index')
            ->with('successMsg', 'Foro creado correctamente');
    }

    public function show($id)
    {
        $foro = Foro::findOrFail($id);
        return view('foros.show', compact('foro'));
    }

    public function edit($id)
    {
        $foro = Foro::findOrFail($id);
        return view('foros.edit', compact('foro'));
    }

    public function update(Request $request, $id)
    {
        $foro = Foro::findOrFail($id);

        $foro->titulo = $request->titulo;
        $foro->descripcion = $request->descripcion;

        $foro->save();

        return redirect()->route('foros.index')
            ->with('success', 'Foro actualizado correctamente.');
    }
}
