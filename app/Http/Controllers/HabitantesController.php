<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\Institucion;
use App\Models\TipoDocumento;
use App\Models\Sede;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InstitucionRequest;
use App\Models\Habitante;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HabitantesController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $habitantes = Habitante::with(['ciudad.tipodocumentos'])
        ->where(function ($query) use ($search) {
            if ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%") 
                      ->orWhereHas('ciudad', function ($q) use ($search) {
                          $q->where('nombre', 'like', "%{$search}%")
                            ->orWhereHas('tipodocumento', function ($q) use ($search) {
                                $q->where('nombre', 'like', "%{$search}%");
                            });
                      });
            }
        })->paginate($perPage);

        $contador1 = Habitante::where('comuna', 'comuna_1')->count();
        $contador2 = Habitante::where('comuna', 'comuna_2')->count();
        $contador3 = Habitante::where('comuna', 'comuna_3')->count();
        $contador4 = Habitante::where('comuna', 'comuna_4')->count();
        $contador5 = Habitante::where('comuna', 'comuna_5')->count();
        $contador6 = Habitante::where('comuna', 'comuna_6')->count();
    
        return view('habitantes.index', compact(
            'habitantes',
            'contador1', 'contador2', 'contador3',
            'contador4', 'contador5', 'contador6'
        ));
}

    public function create()
    {
        $paises = Pais::where('estado', '=', '1')->orderBy('nombre')->get();
		$departamentos = Departamento::where('estado', '=', '1')->orderBy('nombre')->get();
		$ciudads = Ciudad::where('estado', '=', '1')->orderBy('nombre')->get();
        $tipodocumentos = TipoDocumento::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('habitantes.create',compact('departamentos','tipodocumentos','ciudads','paises'));
    }

    public function store(Request $request)
    {
		DB::beginTransaction();
		try 
		{
			$image = $request->file('image');
			$slug = Str::slug($request->nombre);
			if (isset($image))
			{
				$currentDate = Carbon::now()->toDateString();
				$imagename = $slug.'-'.$currentDate.'-'. uniqid() .'.'. $image->getClientOriginalExtension();

				if (!file_exists('uploads/habitante'))
				{
					mkdir('uploads/habitante',0777,true);
				}
				$image->move('uploads/habitante',$imagename);
			}else{
				$imagename = "";
			}
			
			$habitante = new Habitante();
			$habitante->tipodocumento_id = $request->tipodocumento_id;
			$habitante->ciudad_id = $request->ciudad_id;
			$habitante->nombre = $request->nombre;
			$habitante->apellido = $request->apellido;
			$habitante->descripcion = $request->descripcion;
			$habitante->comuna = $request->comuna;
			$habitante->numerodocumento = $request->numerodocumento;
			$habitante->image = $imagename;
			$habitante->estado = 1;
			$habitante->registradopor = $request->user()->id;
			$habitante->save();
			
			$idhabitante = $habitante->id;

			

			DB::commit();
			return redirect()->route('habitantes.index')->with('successMsg', 'El registro se guardó exitosamente');
		
		} catch (Exception $e) {
			DB::rollBack();
			return redirect()->back()->with('errorMsg', 'Error al registrar la información');
		}
    }

    public function show(Habitante $habitante)
{
    // Obtener los datos relacionados
    $departamento = $habitante->ciudad->departamento;
    $pais = $departamento->pais;
    $tipoDocumento = $habitante->tipoDocumento;

    return view('habitantes.show', compact('habitante', 'departamento', 'pais', 'tipoDocumento'));
}

    public function edit(Habitante $habitante)
    {
        $departamentos = Departamento::all();
        $tipodocumentos = TipoDocumento::all();
        $paises = Pais::all();
        $ciudads = Ciudad::all();

        return view('habitantes.edit',compact('tipodocumentos','departamentos','ciudads','habitante','paises'));
    }

    public function update(Request $request, Habitante $habitante)
{
    // Verificar si se ha subido una nueva imagen
    if ($request->hasFile('image')) {
        // Obtener la nueva imagen
        $image = $request->file('image');
        $slug = Str::slug($request->nombre); // Usar Str::slug() en lugar de str_slug()
        $currentDate = Carbon::now()->toDateString();
        $imageName = $slug . '-' . $currentDate . '.' . $image->getClientOriginalExtension();

        // Verificar si ya existe una imagen y eliminarla
        if (Storage::disk('public')->exists('uploads/habitantes/' . $habitante->image)) {
            Storage::disk('public')->delete('uploads/habitantes/' . $habitante->image);
        }

        // Guardar la nueva imagen
        $image->storeAs('uploads/habitantes/', $imageName, 'public');
    } else {
        // Mantener la imagen actual si no se sube una nueva
        $imageName = $habitante->image;
    }

    // Actualizar la institución con los datos recibidos
    $habitante->update($request->all());
    $habitante->image = $imageName;
    $habitante->save();

    return redirect()->route('habitantes.index')->with('successMsg', 'El registro se actualizó exitosamente');
}
	
	public function destroy(Habitante $habitante)
    {
	   try {
            $habitante->delete();
            return redirect()->route('habitantes.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('habitantes.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('habitantes.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadohabitante(Request $request)
	{
		$habitante = Habitante::find($request->id);
		$habitante->estado=$request->estado;
		$habitante->save();
	}
    
    public function getDepartamentos(Request $request)
    {
        $detalleDepartamentos = Departamento::select('departamentos.id', 'departamentos.nombre')
            ->where('departamentos.pais_id', $request->pais_id)
            ->orderBy('departamentos.nombre')
            ->get();
    
        if (count($detalleDepartamentos) > 0) {
            return response()->json($detalleDepartamentos);
        } else {
            return response()->json(['message' => 'No se encontraron departamentos'], 404);
        }
    }
    
    public function getCiudads(Request $request)
    {
        $detalleCiudades = Ciudad::select('ciudads.id', 'ciudads.nombre')
            ->where('ciudads.departamento_id', $request->departamento_id)
            ->orderBy('ciudads.nombre')
            ->get();
    
        if (count($detalleCiudades) > 0) {
            return response()->json($detalleCiudades);
        } else {
            return response()->json(['message' => 'No se encontraron ciudades'], 404);
        }
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