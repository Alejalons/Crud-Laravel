<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Middleware\Authenticate;


class EmpleadosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //alamacena todos los registos paginados por 5 a 5 y lo manda a indez.blade.php
        $datos['empleados'] = Empleados::paginate(5);

        return view('empleados.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleados.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validaciones
        $campos=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mine:jpeg,png,jpg'
        ];
        $Mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);



        //recolecta informacion enviada por post del formulario
        //$datosEmpleado = request() -> all();
        $datosEmpleado = request() -> except('_token');
        
        if( $request -> hasFile('foto')){

            $datosEmpleado['foto'] = $request -> file('foto') -> store('uploads', 'public');
        }


        //insert
        if(Empleados::insert($datosEmpleado)){

             return redirect('empleados') -> with('Mensaje', 'Empleado Agregado con exito');

        }

        //muestra lo que mandamos
        // return response() -> json($datosEmpleado);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show(Empleados $empleados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleados::findOrFail($id);

        return view('empleados.edit', compact('empleado')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validaciones
        $campos=[
            'Nombre' => 'required|string|max:100',
            'ApellidoPaterno' => 'required|string|max:100',
            'ApellidoMaterno' => 'required|string|max:100',
            'Correo' => 'required|email'
        ];
        if( $request -> hasFile('Foto')){
            
            $campos += ['Foto' => 'required|max:10000|mines:jpeg,png,jpg'];
        }

        $Mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $campos, $Mensaje);


        $datosEmpleado = request() -> except(['_token', '_method']);

        if( $request -> hasFile('Foto')){
            //borra foto del storage / 1° buscar  - 2° elimina
            $empleado = Empleados::findOrFail($id);
            Storage::delete('public/'. $empleado -> Foto);

            $datosEmpleado['Foto'] = $request -> file('Foto') -> store('uploads', 'public');
        }     

        //actualiza
        Empleados::where('id', '=' , $id) -> update($datosEmpleado);
        
        //busca
        $empleado = Empleados::findOrFail($id);
        // return view('empleados.edit', compact('empleado'));
        return redirect('empleados') -> with('Mensaje', 'Empleado Modificado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleados::findOrFail($id);

        
        if( Storage::delete('public/'. $empleado -> Foto)  )
        {
            Empleados::destroy($id);
        }

        return redirect('empleados')-> with('Mensaje', 'Empleado eliminado con exito');
    }
}
