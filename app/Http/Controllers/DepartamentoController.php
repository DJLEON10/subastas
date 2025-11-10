<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Pais;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartamentoRequest;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\BSON\Regex;
use MongoDB\BSON\ObjectId;

class DepartamentoController extends Controller
{
    public function index(Request $request){
        $search = trim($request->input('search', ''));
        $perPage = (int) $request->input('per_page', 10);

        $query = Departamento::with('pais');

        if ($search !== '') {

            // activo o inactivo
            $lower = strtolower($search);
            if ($lower === 'activo') $search = '1';
            if ($lower === 'inactivo') $search = '0';

            // Condiciones Mongo
            $conditions = [];

            // busqueda por departamento
            $conditions[] = ['nombre' => ['$regex' => new Regex($search, 'i')]];

            // busqueda por país
            $paises = Pais::where('nombre', 'like', "%{$search}%")->get();
            $paisesIds = $paises->pluck('_id')->map(fn($id) => (string)$id)->toArray();

            if (!empty($paisesIds)) {
                $conditions[] = ['pais_id' => ['$in' => $paisesIds]];
            }

            // busqueda por estado ignorando otras condiciones
            if ($search === '1' || $search === '0') {
                $conditions = [['estado' => $search]]; 
            }

            // Condiciones con OR
            $query->whereRaw(['$or' => $conditions]);
        }

        $departamentos = $query->paginate($perPage);

        return view('departamentos.index', compact('departamentos'));
    }


    public function create()
    {
		$paises = Pais::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('departamentos.create',compact('paises'));
    }

    public function store(DepartamentoRequest $request)
    {
		$departamento = Departamento::create($request->all());
		return redirect()->route('departamentos.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show(Departamento $departamento)
    {
        //
    }

    public function edit(Departamento $departamento)
    {
        $paises = Pais::all();
        return view('departamentos.edit',compact('departamento','paises'));
    }

    public function update(DepartamentoRequest $request, Departamento $departamento)
    {
        $departamento->update($request->all());
        return redirect()->route('departamentos.index')->with('successMsg','El registro se actualizó exitosamente');
    }
	
	public function destroy(Departamento $departamento)
    {
		try {
            $departamento->delete();
            return redirect()->route('departamentos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el departamento: ' . $e->getMessage());
            return redirect()->route('departamentos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el departamento: ' . $e->getMessage());
            return redirect()->route('departamentos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadodepartamento(Request $request)
	{
		$departamento = Departamento::find($request->id);
		$departamento->estado=$request->estado;
		$departamento->save();
	}

    public function getDepartamentos(Request $request)
{
    // Validar que venga el parámetro pais_id
    if (!$request->has('pais_id')) {
        return response()->json(['error' => 'Falta el parámetro pais_id'], 400);
    }

    $paisId = $request->pais_id;

    // Buscar los departamentos de ese país
    $detalleDepartamentos = Departamento::where('pais_id', $paisId)
        ->select('_id', 'nombre')
        ->orderBy('nombre', 'asc')
        ->get();

    // Si hay resultados, devolverlos
    if ($detalleDepartamentos->count() > 0) {
        return response()->json($detalleDepartamentos);
    }

    // Si no hay departamentos
    return response()->json([]);
}

public function getDepartamentosEdit(Request $request)
{
    if ($request->ajax()) 
    {
        if ($request->ajax()) {
        $detalleDepartamentos = Departamento::select ('departamentos.id','departamentos.nombre')
        ->join('paises', 'paises.id', '=', 'departamentos.pais_id')
        ->where('departamentos.pais_id', $request->pais_id)
        ->orderBy('departamentos.nombre')
        ->get();
        foreach ($detalleDepartamentos as $detalleDepartamento) {
            $departamentosArray[$detalleDepartamento->id] = $detalleDepartamento->nombre;
        }
        return response()->json($departamentosArray);
        }
    }
}
}