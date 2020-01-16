<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\User;
use DB;
use Log;
use Exception;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adm.usuarios.index');
    }

    public function listar()
    {
        try {
            $usuarios = User::where('id','!=', auth()->user()->id)->get();

            $usuarios->each(function($usuarios){
                if ($usuarios->rol == 'admin')
                    $usuarios->rol = 'Administrador';
                else
                    $usuarios->rol = 'Normal';
                return $usuarios;
            });
     
            return Datatables::of($usuarios)->make(true);

        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en UserController: '.$e->getMessage().', Linea: '.$e->getLine());
        }
    }

    public function store(Request $request)
    {   

        $this->validate($request, 
        [
            'email'=>'required|email|unique:users,email',
            'username'=>'required|min:3|max:10|unique:users,username',
            'name'=>'required|alpha|min:5|max:45',
            'rol'=>'required|alpha',
            'password' => 'required|alpha_num|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        DB::beginTransaction();
        try {
            $usuario = new User($request->all());
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            DB::commit();
            return response()->json($usuario);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en UserController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.'
                ], 500);
        }

    }
    public function show($id)
    {

        try {
            $usuario = User::findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            Log::error('Ha ocurrido un error en UsersController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.'
                ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [   
                'email'=>'required|email|unique:users,email,'.$id,
                'username'=>'required|min:3|max:10|unique:users,username,'.$id,
                'name'=>'required|alpha|min:5|max:45',
                'rol'=>'required|alpha',
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|min:6'
            ]);

         DB::beginTransaction();
        try {
            $usuario = User::findOrFail($id);
            $pass_last = $usuario->password;
            $usuario->fill($request->all());
            if($request->password != null || !empty($request->password)){
                $usuario->password = bcrypt($request->password);
            }else{
                $usuario->password = $pass_last;
            }
            $usuario->save();
            DB::commit();
            return response()->json($usuario);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en UsersController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.'
                ], 500);
        }

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            DB::commit();
            return response()->json($usuario);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Ha ocurrido un error en UsersController: '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar los datos. El usuario debe estar relacionado en alguna operación.'
                ], 500);
        }
    }

    public function perfil()
    {   
        $user = auth()->user();
        return view('adm.usuarios.perfil')->with('user', $user);
    }

    public function perfilUpdate(Request $request)
    {
        $this->validate($request, 
            [   
                'email'=>'required|email|unique:users,email,'.$request->id,
                'username'=>'required|min:3|max:10|unique:users,username,'.$request->id,
                'name'=>'required|alpha|min:5|max:45',
                'rol'=>'nullable|alpha',
                'password' => 'nullable|min:6|confirmed',
                'password_confirmation' => 'nullable|min:6'
            ]);

        DB::beginTransaction();
        try {
            $usuario = User::findOrFail($request->id);
            $pass_last = $usuario->password;
            $usuario->fill($request->all());
            if($request->password != null || !empty($request->password)){
                $usuario->password = bcrypt($request->password);
            }else{
                $usuario->password = $pass_last;
            }
            $usuario->save();
            DB::commit();

            Flash::success("Se ha actualizado el perfil!!");         
            return redirect()->route('perfil');
        } catch (\Exception $e) {
            DB::rollback();
            Flash::error("Hubo un error en la actualización del perfil!!");         
            return redirect()->route('perfil');
        }
    }
}
