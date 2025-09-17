<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request\sliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;


class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'nombre_boton' => 'required|string|max:255',
        'link_boton' => 'nullable|url',
        'descripcion' => 'required|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $image = $request->file('imagen');
        $slug = Str::slug($request->nombre);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '-' . $image->getClientOriginalName();

            if (!file_exists('uploads/slider')) {
                mkdir('uploads/slider', 0777, true);
            }
            $image->move('uploads/slider', $imageName);
        } else {
            $imageName = "";
        }

        slider::create([
            'titulo' => $request->titulo,
            'nombre_boton' =>$request->nombre_boton,
            'link_boton' => $request->link_boton,
            'descripcion' => $request->descripcion,
            'imagen' => $imageName,
            'estado' => $request->estado,
            'registradopor' => $request->registradopor,
        ]);

        return redirect()->route('sliders.index')->with('successMsg', 'slider creado exitosamente.');
}


    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtén el slider por su ID
        $slider = Slider::find($id);
    
        // Retorna una vista con los detalles del slider
        return view('sliders.show', compact('slider'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('sliders.edit',compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $sliderRequest, $id)
{
    $slider = Slider::findOrFail($id);

    // Validación
    $sliderRequest->validate([
        'titulo' => 'required|string|max:255',
        'nombre_boton' => 'required|string|max:255',
        'link_boton' => 'nullable|url',
        'descripcion' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Actualización manual de campos
    $slider->titulo = $sliderRequest->input('titulo');
    $slider->nombre_boton = $sliderRequest->input('nombre_boton');
    $slider->link_boton = $sliderRequest->input('link_boton');
    $slider->descripcion = $sliderRequest->input('descripcion');

    // Procesar nueva imagen si se envía
    if ($sliderRequest->hasFile('imagen')) {
        $image = $sliderRequest->file('imagen');
        $slug = Str::slug($sliderRequest->titulo);
        $currentDate = Carbon::now()->toDateString();
        $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        if (!file_exists('uploads/slider')) {
            mkdir('uploads/slider', 0777, true);
        }
        $image->move('uploads/slider', $imagename);

        // Actualizar el campo de imagen en la base de datos
        $slider->imagen = $imagename;
    }

    // Guardar los cambios en la base de datos
    $slider->save();

    // Redirigir a la lista de sliders
    return redirect()->route('sliders.index')->with('successMsg', 'El registro se actualizó exitosamente');
}


    public function cambioestadoslider(Request $sliderRequest)
    {
        $slider = Slider::find($sliderRequest->id);
    if ($slider) {
        $slider->estado = $sliderRequest->estado;
        $slider->save();

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
}

public function destroy(Slider $slider)
    {
        try {
            $slider->delete();
            return redirect()->route('sliders.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el país: ' . $e->getMessage());
            return redirect()->route('sliders.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el país: ' . $e->getMessage());
            return redirect()->route('sliders.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
    
}


