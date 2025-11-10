<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CiudadRequest;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use MongoDB\BSON\Regex;

class CiudadController extends Controller
{

    public function index(Request $request){

        $search = trim($request->input('search', ''));
        $perPage = (int) $request->input('per_page', 10);
        $query = Ciudad::with(['departamento.pais']);

        if ($search !== '') {
            // busqueda por activo y inactivo
            $lower = strtolower($search);
            if ($lower === 'activo') $search = '1';
            if ($lower === 'inactivo') $search = '0';

            $conditions = [];

            // Busqueda de ciudad
            $conditions[] = ['nombre' => ['$regex' => new Regex($search, 'i')]];

            // Busqueda de departamento
            $departamentos = Departamento::where('nombre', 'like', "%{$search}%")->get();
            $departamentoIds = $departamentos->pluck('_id')->map(fn($id) => (string)$id)->toArray();

            if (!empty($departamentoIds)) {
                $conditions[] = ['departamento_id' => ['$in' => $departamentoIds]];
            }   

            // Busqueda de país
            $paises = Pais::where('nombre', 'like', "%{$search}%")->get();
            $paisIds = $paises->pluck('_id')->map(fn($id) => (string)$id)->toArray();

            if (!empty($paisIds)) {
                // Busqueda de departamentos que pertenecen al pais
                $departamentosDePaises = Departamento::whereIn('pais_id', $paisIds)->get();
                $departamentosDePaisesIds = $departamentosDePaises->pluck('_id')->map(fn($id) => (string)$id)->toArray();

                if (!empty($departamentosDePaisesIds)) {
                    $conditions[] = ['departamento_id' => ['$in' => $departamentosDePaisesIds]];
                }
            }

            //Busqueda por estado 
            if ($search === '1' || $search === '0') {
                $conditions[] = ['estado' => $search];
            }

            $query->whereRaw(['$or' => $conditions]);
        }

        $ciudads = $query->paginate($perPage);

        return view('ciudads.index', compact('ciudads'));
    }

    public function create()
    {
		$departamentos = Departamento::where('estado', '=', '1')->orderBy('nombre')->get();
        $paises = Pais::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('ciudads.create',compact('departamentos','paises'));
    }

    public function store(CiudadRequest $request)
    {
		$ciudad = Ciudad::create($request->all());
		return redirect()->route('ciudads.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show(Ciudad $ciudad)
    {
        //
    }

    public function edit(Ciudad $ciudad)
    {
        $departamentos = Departamento::all();
        $paises = Pais::all();
        return view('ciudads.edit',compact('paises','departamentos','ciudad'));
    }

    public function update(CiudadRequest $request, Ciudad $ciudad)
    {
        $ciudad->update($request->all());
        return redirect()->route('ciudads.index')->with('successMsg','El registro se actualizó exitosamente');
    }
	
	public function destroy(Ciudad $ciudad)
    {
	   try {
            $ciudad->delete();
            return redirect()->route('ciudads.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('ciudads.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('ciudads.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadociudad(Request $request)
	{
		$ciudad = Ciudad::find($request->id);
		if ($ciudad) { 
			$ciudad->estado = $request->estado;
			$ciudad->save();
			return response()->json(['success' => true]);
		}
		return response()->json(['success' => false, 'message' => 'Ciudad no encontrada.']);
	}

    public function getCiudads(Request $request)
{
    $detalleCiudades = Ciudad::select('_id', 'nombre')
        ->where('departamento_id', $request->departamento_id)
        ->orderBy('nombre')
        ->get();

    if ($detalleCiudades->count() > 0) {
        return response()->json($detalleCiudades);
    } else {
        return response()->json(['message' => 'No se encontraron ciudades'], 404);
    }
}

public function getCiudadsEdit(Request $request)
	{
		if ($request->ajax()) 
		{
			if ($request->ajax()) {
			$detalleCiudades = Ciudad::select ('ciudads.id','ciudads.nombre')
			->join('departamentos', 'departamentos.id', '=', 'ciudads.departamento_id')
			->where('ciudads.departamento_id', $request->departamento_id)
			->orderBy('ciudads.nombre')
			->get();
			foreach ($detalleCiudades as $detalleCiudad) {
				$ciudadsArray[$detalleCiudad->id] = $detalleCiudad->nombre;
			}
			return response()->json($ciudadsArray);
			}
		}
	}

	

}