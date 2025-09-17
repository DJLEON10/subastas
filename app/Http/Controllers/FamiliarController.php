<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartamentoRequest;
use App\Http\Requests\FamiliarRequest;
use App\Models\Familiar;
use App\Models\Habitante;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class FamiliarController extends Controller
{
    public function index(Request $request)
    {
		$search = $request->input('search');
		$perPage = $request->input('per_page', 10);
		$familiares = Familiar::with('habitante')  
		->where(function ($query) use ($search) {
			if ($search) {
				$query->where('nombre', 'like', "%{$search}%")
					->orWhereHas('habitante', function ($q) use ($search) {
						$q->where('nombre', 'like', "%{$search}%");
					});
			}
		})
		->paginate($perPage);
        return view('familiares.index',compact('familiares'));
    }

    public function create()
    {
		$habitantes = Habitante::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('familiares.create',compact('habitantes'));
    }

    public function store(FamiliarRequest $request)
    {
		$familiar = Familiar::create($request->all());
		return redirect()->route('familiares.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show($id)
{
    $familiar = Familiar::with('habitante')->findOrFail($id);
    return view('familiares.show', compact('familiar'));
}

    public function edit(Familiar $familiar)
    {
        $habitantes = Habitante::all();
        return view('familiares.edit',compact('familiar','habitantes'));
    }

    public function update(FamiliarRequest $request, Familiar $familiar)
    {
        $familiar->update($request->all());
        return redirect()->route('familiares.index')->with('successMsg','El registro se actualizó exitosamente');
    }
	
	public function destroy(Familiar $familiar)
    {
		try {
            $familiar->delete();
            return redirect()->route('familiares.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el familiar: ' . $e->getMessage());
            return redirect()->route('familiares.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el familiar: ' . $e->getMessage());
            return redirect()->route('familiares.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadofamiliar(Request $request)
	{
		$familiar = Familiar::find($request->id);
		$familiar->estado=$request->estado;
		$familiar->save();
	}

    public function getFamiliares(Request $request)
    {
        
            $habitanteId = $request->habitante_id;
        
            // Suponiendo que tienes una relación en tu modelo Habitante llamada "familiares"
            $familiares = Familiar::where('habitante_id', $habitanteId)->get(['id', 'nombre']);
        
            return response()->json($familiares);
        
    }
}