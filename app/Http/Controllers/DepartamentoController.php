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

class DepartamentoController extends Controller
{
    public function index(Request $request)
    {
		$search = $request->input('search');
		$perPage = $request->input('per_page', 10);
		$departamentos = Departamento::with('pais')  
		->where(function ($query) use ($search) {
			if ($search) {
				$query->where('nombre', 'like', "%{$search}%")
					->orWhereHas('pais', function ($q) use ($search) {
						$q->where('nombre', 'like', "%{$search}%");
					});
			}
		})
		->paginate($perPage);
        return view('departamentos.index',compact('departamentos'));
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
}