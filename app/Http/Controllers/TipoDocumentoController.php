<?php

namespace App\Http\Controllers;

use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TipoDocumentoRequest;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;

class TipoDocumentoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
		$perPage = $request->input('per_page', 10);
		$tipodocumentos = TipoDocumento::where(function ($query) use ($search) {
			if ($search) {
				$query->where('nombre', 'like', "%{$search}%");
			}
		})->paginate($perPage);
        return view('tipodocumentos.index',compact('tipodocumentos'));
    }

    public function create()
    {
        return view('tipodocumentos.create');
    }

    public function store(TipoDocumentoRequest $request)
    {
		$tipodocumento = TipoDocumento::create($request->all());
		return redirect()->route('tipodocumentos.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show(TipoDocumento $tipodocumento)
    {
        //
    }

    public function edit(TipoDocumento $tipodocumento)
    {
        return view('tipodocumentos.edit',compact('tipodocumento'));
    }

    public function update(TipoDocumentoRequest $request, TipoDocumento $tipodocumento)
    {
        $tipodocumento->update($request->all());
        return redirect()->route('tipodocumentos.index')->with('successMsg','El registro se actualizó exitosamente');
    }
	
	public function destroy(TipoDocumento $tipodocumento)
    {
		try {
            $tipodocumento->delete();
            return redirect()->route('tipodocumentos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el tipo de documento: ' . $e->getMessage());
            return redirect()->route('tipodocumentos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el tipo de documento: ' . $e->getMessage());
            return redirect()->route('tipodocumentos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadotipodocumento(Request $request)
	{
		$tipodocumento = TipoDocumento::find($request->id);
		$tipodocumento->estado=$request->estado;
		$tipodocumento->save();
	}
}