<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //funcion para mostrar los datos 
    public function index()
    {
        //obtener o acceder a los datos
        $teachers = Teachers::all();

        //parametro del json que obtiene los datos
        $data = [
            'message' => 'Teachers encontrados',
            'teachers' => $teachers,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    //registrar datos, post, haciendo uso de Request
    public function store(Request $request)
    {
        //validacion de datos, accediendo a los datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|unique:teachers|max:8',
            'phone' => 'required|max:10',
            'cargo' => 'required|max:255'
        ]);

        //si no se validan los datos
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error al validar los registros',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        //si los datos se validan se crea un nuevo registro
        $teachers = Teachers::create($request->all());

        //si no puede crearse
        if (!$teachers) {
            return response()->json([
                'message' => 'Error al crear un nuevo profesor',
                'status' => 500
            ], 500);
        }

        //muestra los nuevos datos registrados 
        return response()->json([
            'message' => 'Datos registrados correctamente',
            'teacher' => $teachers,
            'status' => 201
        ], 201);
    }

    //funcion para buscar un registro especifico
    public function show($id)
    {
        $teachers = Teachers::find($id);

        //si no encontraste es retorna un json
        if (!$teachers) {
            return response()->json(
                [
                    'message'=>'no se encontraron datos',
                    'status' =>404
                ],404
            );
        }
        //se encontraron datos
        $datos = [
            'message' => 'Datos encontrados',
            'teachers' => $teachers,
            'status' => 202
        ];
        return response()->json($datos, 202);

    }

    public function update(Request $request, $id)
{
    $teachers = Teachers::find($id);

    // Validar si hay registros
    if (!$teachers) {
        return response()->json([
            'message' => 'Error: No se encontró el registro para actualizar',
            'status' => 404
        ], 404);
    }

    // Validar los datos de actualización
    $validator = Validator::make($request->all(), [
        'name' => 'max:255',
        'lastname' => 'max:255',
        'dni' => 'unique:teachers,dni,'.$id.'|max:8',
        'phone' => 'max:10',
        'cargo' => 'max:255'
    ]);

    // Si la validación falla, devolver errores
    if ($validator->fails()) {
        return response()->json([
            'message' =>'Error en la validación de los datos a actualizar',
            'errors' => $validator->errors(),
            'status' => 400
        ], 400);
    }

    // Actualizar los campos proporcionados en la solicitud
    // Actualizar solo los campos recibidos
    if ($request->has('name')) {
        $teachers->name = $request->name;
    }
    if ($request->has('lastname')) {
        $teachers->lastname = $request->lastname;
    }
    if ($request->has('dni')) {
        $teachers->dni = $request->dni;
    }
    if ($request->has('phone')) {
        $teachers->phone = $request->phone;
    }
    if ($request->has('cargo')) {
        $teachers->cargo = $request->cargo;
    }


    // Guardar los cambios en la base de datos
    $teachers->save();

    // Mostrar los nuevos registros actualizados
    return response()->json([
        'message' => 'Datos actualizados correctamente',
        'teachers' => $teachers,
        'status' => 200
    ], 200);
}

public function destroy($id){
    $teachers = Teachers::find($id);

    if (!$teachers) {
        return response()->json(
            [
                'message' => 'No se pudo eliminar el registro',
                'status' => 404
            ], 404
        );
    }

    $teachers->delete();

    return response()->json(
        [
            'mesage' => 'Teacher eliminado',
            'status' => 202
        ], 202
    );

}

}