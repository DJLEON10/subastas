<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PaisRequest;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use MongoDB\BSON\Regex;


class PaisController extends Controller
{

    public function index(Request $request){
        $search = trim($request->input('search', ''));
        $perPage = (int) $request->input('per_page', 10);

        $query = Pais::query();

        if ($search !== '') {
            $lower = strtolower($search);

            // Busqueda de estado
            if ($lower === 'activo') $search = '1';
            if ($lower === 'inactivo') $search = '0';

            // búsqueda si es 1 o 0 
            if ($search === '1' || $search === '0') {
            $query->where('estado', $search);
            } else {
                // Búsqueda general 
                $query->whereRaw([
                    '$or' => [
                        ['nombre' => ['$regex' => new Regex($search, 'i')]],
                    ]
                ]);
            }
        }

        $paises = $query->paginate($perPage);

        return view('paises.index', compact('paises'));
    }

    public function create()
    {
        return view('paises.create');
    }

    public function store(PaisRequest $request)
    {
		$pais = Pais::create($request->all());
		return redirect()->route('paises.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show(Pais $pais)
    {
        //
    }

    public function edit(Pais $paise)
    {
        return view('paises.edit',compact('paise'));
    }

    public function update(PaisRequest $request, Pais $paise)
    {
        $paise->update($request->all());
        return redirect()->route('paises.index')->with('successMsg','El registro se actualizó exitosamente');
    }
	
	public function destroy(Pais $paise)
    {
		try {
            $paise->delete();
            return redirect()->route('paises.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el país: ' . $e->getMessage());
            return redirect()->route('paises.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el país: ' . $e->getMessage());
            return redirect()->route('paises.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadopais(Request $request)
	{
		$pais = Pais::find($request->id);
		$pais->estado=$request->estado;
		$pais->save();
	}
}