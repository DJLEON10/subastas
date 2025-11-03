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
use App\Models\Producto;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $productos = Producto::with(['ciudad'])
        ->where(function ($query) use ($search) {
            if ($search) {
                $query->where('nombre', 'like', "%{$search}%")
                      ->orWhere('apellido', 'like', "%{$search}%") 
                      ->orWhereHas('ciudad', function ($q) use ($search) {
                          $q->where('nombre', 'like', "%{$search}%")
                            ->orWhereHas('ciudad', function ($q) use ($search) {
                                $q->where('nombre', 'like', "%{$search}%");
                            });
                      });
            }
        })->paginate($perPage);


        return view('productos.index', compact(
            'productos'
            
        ));
}

    public function create()
    {
        $paises = Pais::where('estado', '=', '1')->orderBy('nombre')->get();
		$departamentos = Departamento::where('estado', '=', '1')->orderBy('nombre')->get();
		$ciudads = Ciudad::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('productos.create',compact('departamentos','ciudads','paises'));
    }

    public function store(Request $request)
    {
        try {
            $image = $request->file('image');
            $slug = Str::slug($request->nombre);
            $imagename = "";
    
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists(public_path('uploads/producto'))) {
                    mkdir(public_path('uploads/producto'), 0777, true);
                }
                $image->move(public_path('uploads/producto'), $imagename);
            }
    
            $producto = new Producto();
            $producto->ciudad_id = $request->ciudad_id;
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio = $request->precio;
            $producto->cantidad = $request->cantidad;
            $producto->categoria = $request->categoria;
            $producto->fechaInicio = $request->fechaInicio;
            $producto->fechaFin = $request->fechaFin;
            $producto->incrementoMinimo = $request->incrementoMinimo;
            $producto->image = $imagename;
            $producto->estado = 1;
            $producto->registradopor = $request->user()?->id; // opcional null-safe
            $producto->save();
    
            // Aquí sí puedes depurar
            Log::info('Producto guardado: ' . $producto->nombre);
            return redirect()->route('productos.index')->with('successMsg', 'El registro se guardó exitosamente');
    
        } catch (\Exception $e) {
            Log::error('Error al guardar producto: ' . $e->getMessage());
            return redirect()->back()->with('errorMsg', 'Error al registrar la información: ' . $e->getMessage());
        }
    }
    
    public function show(Producto $producto)
{
    // Obtener los datos relacionados
    $departamento = $producto->ciudad->departamento;
    $pais = $departamento->pais;

    return view('productos.show', compact('producto', 'departamento', 'pais',));
}

    public function edit(Producto $producto)
    {
        $departamentos = Departamento::all();
        $paises = Pais::all();
        $ciudads = Ciudad::all();

        return view('productos.edit',compact('departamentos','ciudads','producto','paises'));
    }

    public function update(Request $request, Producto $producto)
{
    // Verificar si se ha subido una nueva imagen
    if ($request->hasFile('image')) {
        // Obtener la nueva imagen
        $image = $request->file('image');
        $slug = Str::slug($request->nombre); // Usar Str::slug() en lugar de str_slug()
        $currentDate = Carbon::now()->toDateString();
        $imageName = $slug . '-' . $currentDate . '.' . $image->getClientOriginalExtension();

        // Verificar si ya existe una imagen y eliminarla
        if (Storage::disk('public')->exists('uploads/productos/' . $producto->image)) {
            Storage::disk('public')->delete('uploads/productos/' . $producto->image);
        }

        // Guardar la nueva imagen
        $image->storeAs('uploads/productos/', $imageName, 'public');
    } else {
        // Mantener la imagen actual si no se sube una nueva
        $imageName = $producto->image;
    }

    // Actualizar la institución con los datos recibidos
    $producto->update($request->all());
    $producto->image = $imageName;
    $producto->save();

    return redirect()->route('productos.index')->with('successMsg', 'El registro se actualizó exitosamente');
}
	
	public function destroy(Producto $producto)
    {
	   try {
            $producto->delete();
            return redirect()->route('productos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('productos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el ciudad: ' . $e->getMessage());
            return redirect()->route('productos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadoproducto(Request $request)
	{
		$producto = Producto::find($request->id);
		$producto->estado=$request->estado;
		$producto->save();
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