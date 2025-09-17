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

class CiudadController extends Controller
{
    public function index(Request $request)
    {
		$search = $request->input('search');
		$perPage = $request->input('per_page', 10);
        $ciudads = Ciudad::with(['departamento.pais'])
            ->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('nombre', 'like', "%{$search}%")
                    ->orWhereHas('departamento', function ($q) use ($search) {
						$q->where('nombre', 'like', "%{$search}%")
						->orWhereHas('pais', function ($q) use ($search) {
							$q->where('nombre', 'like', "%{$search}%");
						});
                    });
                }
            })->paginate($perPage);
		return view('ciudads.index',compact('ciudads'));
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
	
	public function getDepartamentos(Request $request)
	{
		$detalleDepartamentos = Departamento::select ('departamentos.id','departamentos.nombre')
		->where('departamentos.pais_id', $request->pais_id)
		->orderBy('departamentos.nombre')
		->get();

		if (count($detalleDepartamentos) > 0) {
            return response()->json($detalleDepartamentos);
        }
	}
}