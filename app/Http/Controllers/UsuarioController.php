<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;


class UsuarioController extends Controller
{
    public function index(Request $request)
    {
		$search = $request->input('search');
		$perPage = $request->input('per_page', 10);
		$users = User::where(function ($query) use ($search) {
			if ($search) {
				$query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
			}
		})->paginate($perPage);
        return view('users.index',compact('users'));
    }

    public function create()
    {
		$users = User::all();
		return view('users.create',compact('users'));
    }

    public function store(UsuarioRequest $request)
    {

		$image = $request->file('image');
		$slug = Str::slug($request->name);
		if (isset($image))
		{
			$currentDate = Carbon::now()->toDateString();
			$imagename = $slug.'-'.$currentDate.'-'. uniqid() .'.'. $image->getClientOriginalExtension();

			if (!file_exists('uploads/users'))
			{
				mkdir('uploads/users',0777,true);
			}
			$image->move('uploads/users',$imagename);
		}else{
			$imagename = "";
		}

		$user = new User();
		$user->name = $request->input('name');
		$user->documento = $request->input('documento');
		$user->telefono = $request->input('telefono');
		$user->email = $request->input('email');
		$user->password = Hash::make($request->input('password'));
		$user->remember_token =  Str::random(60);
		$user->rol =$request->input('rol');
		$user->save();
    
        return redirect()->route('users.index')->with('successMsg','El registro se guardó exitosamente');
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
		return view('users.edit', compact('user'));
    }

	public function update(Request $request, User $user)
		{
		

		try {
			// Si el usuario sube una nueva imagen, procesarla
			if ($request->hasFile('image')) {
				$image = $request->file('image');
				$slug = Str::slug($request->name);
				$currentDate = Carbon::now()->toDateString();
				$imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
	
				// Crear la carpeta si no existe
				if (!file_exists(public_path('uploads/users'))) {
					mkdir(public_path('uploads/users'), 0777, true);
				}
	
				// Guardar la imagen en la carpeta
				$image->move(public_path('uploads/users'), $imagename);
	
				// Eliminar la imagen anterior si existía
				if (!empty($user->photo) && file_exists(public_path('uploads/users/' . $user->photo))) {
					unlink(public_path('uploads/users/' . $user->photo));
				}
	
				// Actualizar la nueva imagen en el usuario
				$user->photo = $imagename;
			}
	
			// Si el usuario cambia la contraseña, encriptarla antes de guardar
			if ($request->has('password') && $request->password !== null && $request->password !== '') {
				$user->password = Hash::make($request->password);
			}
			

	
			// Actualizar los demás campos
			$user->name = $request->name;
			$user->email = $request->email;
			$user->rol = $request->rol;
			$user->estado = $request->rol;

	
			// Guardar cambios
			$user->save();
	
			return redirect()->route('users.index')->with('successMsg', 'El usuario se actualizó correctamente.');
		} catch (\Exception $e) {
			Log::error('Error al actualizar usuario: ' . $e->getMessage());
			return redirect()->route('users.index')->withErrors('Hubo un error al actualizar el usuario.');
		}
	}
	
	public function destroy(User $user)
    {
		try {
            $user->delete();
            return redirect()->route('users.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el tipo de documento: ' . $e->getMessage());
            return redirect()->route('users.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el tipo de documento: ' . $e->getMessage());
            return redirect()->route('users.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
	
	public function cambioestadouser(Request $request)
	{
		$user = User::find($request->id);
		$user->estado=$request->estado;
		$user->save();
	}
}
