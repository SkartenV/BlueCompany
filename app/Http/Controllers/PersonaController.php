<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['personas']=Persona::paginate(1);
        return view('persona.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Cargo'=>'required|string|max:100',
            'Peso'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:200',
            'Link'=>'required|string|max:100',
            'Imagen'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Descripcion.required'=>'La descripción es requerida',
            'Imagen.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos, $mensaje);

        //$datosPersona = request()->all();
        $datosPersona = request()->except('_token');

        if($request->hasFile('Imagen')){
            $datosPersona['Imagen']=$request->file('Imagen')->store('uploads','public');
        }

        // Insertar a la Base de Datos
        Persona::insert($datosPersona);
        return redirect('persona')->with('mensaje', 'Empleado agregado con éxito');

        /*
        revisar si existe la imagen
        image = $request->file('img_path');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        Storage::put(
            'public/images/licenses/'.$imagename,
            file_get_contents($request->file('img_path')->getRealPath())
        );
        $url = 'storage/images/licenses/'.$imagename;

        $conf = Configuration::updateOrCreate(
            ['type' => 'lic_image'],
            ['name' => 'Imagen Licencia', 'value' => $url]
        );
        */


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona=Persona::findOrFail($id);
        return view('persona.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Cargo'=>'required|string|max:100',
            'Peso'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:200',
            'Link'=>'required|string|max:100'
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Descripcion.required'=>'La descripción es requerida',
        ];

        if($request->hasFile('Imagen')){
            $campos=['Imagen'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Imagen.required'=>'La foto es requerida'];
        }
        $this->validate($request, $campos, $mensaje);

        $datosPersona = request()->except(['_token', '_method']);

        if($request->hasFile('Imagen')){
            $persona=Persona::findOrFail($id);
            Storage::delete('public/'.$persona->imagen);
            $datosPersona['Imagen']=$request->file('Imagen')->store('uploads','public');
        }

        Persona::where('id','=',$id)->update($datosPersona);
        $persona=Persona::findOrFail($id);
        //return view('persona.edit', compact('persona'));
        return redirect('persona')->with('mensaje', 'Empleado modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona=Persona::findOrFail($id);
        if(Storage::delete('public/'.$persona->imagen)){
            Persona::destroy($id);
        }
        
        return redirect('persona')->with('mensaje', 'Empleado borrado');
    }
}
