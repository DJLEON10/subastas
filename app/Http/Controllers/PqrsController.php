<?php

namespace App\Http\Controllers;

use App\Models\Pqrs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use MongoDB\BSON\Regex;
use Exception;

class PqrsController extends Controller
{
    public function index(Request $request)
    {
        $search  = trim($request->input('search', ''));
        $perPage = (int) $request->input('per_page', 10);

        $query = Pqrs::with('usuario');

        if ($search !== '') {
            $lower = strtolower($search);

            if ($lower === 'activo') $search = '1';
            if ($lower === 'inactivo') $search = '0';

            if ($search === '1' || $search === '0') {
                $query->where('estado', $search);
            } else {
                $query->whereRaw([
                    '$or' => [
                        ['tipo'        => ['$regex' => new Regex($search, 'i')]],
                        ['asunto'      => ['$regex' => new Regex($search, 'i')]],
                        ['descripcion' => ['$regex' => new Regex($search, 'i')]],
                        ['correo'      => ['$regex' => new Regex($search, 'i')]],
                        ['telefono'    => ['$regex' => new Regex($search, 'i')]],
                    ]
                ]);
            }
        }

        $pqrs = $query
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('pqrs.index', compact('pqrs'));
    }

    public function create()
    {
        return view('pqrs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo'        => 'required|string|max:255',
            'asunto'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'correo'      => 'required|email|max:255',
            'telefono'    => 'nullable|string|max:50',
            'estado'      => 'nullable|string|max:10',
        ]);

        $data['usuario_id'] = Auth::id();

        if (!isset($data['estado']) || $data['estado'] === null || $data['estado'] === '') {
            $data['estado'] = '1';
        }

        Pqrs::create($data);

        return redirect()
            ->route('pqrs.index')
            ->with('successMsg', 'La PQR se guardó exitosamente');
    }

    public function show(Pqrs $pqr)
    {
        return view('pqrs.show', compact('pqr'));
    }

    public function edit(Pqrs $pqr)
    {
        return view('pqrs.edit', compact('pqr'));
    }

    public function update(Request $request, Pqrs $pqr)
    {
        $data = $request->validate([
            'tipo'        => 'required|string|max:255',
            'asunto'      => 'required|string|max:255',
            'descripcion' => 'required|string',
            'correo'      => 'required|email|max:255',
            'telefono'    => 'nullable|string|max:50',
            'estado'      => 'nullable|string|max:10',
        ]);

        $pqr->update($data);

        return redirect()
            ->route('pqrs.index')
            ->with('successMsg', 'La PQR se actualizó exitosamente');
    }

    public function destroy(Pqrs $pqr)
    {
        try {
            $pqr->delete();

            return redirect()
                ->route('pqrs.index')
                ->with('successMsg', 'La PQR se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la PQR: ' . $e->getMessage());
            return redirect()
                ->route('pqrs.index')
                ->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la PQR: ' . $e->getMessage());
            return redirect()
                ->route('pqrs.index')
                ->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadopqrs(Request $request)
    {
        $pqr = Pqrs::find($request->id);

        if ($pqr) {
            $pqr->estado = $request->estado;
            $pqr->save();

            return response()->json([
                'success' => 'Estado actualizado correctamente',
                'estado'  => $pqr->estado
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'PQR no encontrada'
        ], 404);
    }
}
