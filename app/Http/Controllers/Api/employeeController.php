<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class employeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();

        return Response()->json([
            'employee' => $employee,
            'status' => 200
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'area' => 'required|max:255',
            'turno' => 'required|max:255',
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $employee = Employee::create($request->all());

        // Si hay un error al crear el estudiante
        if (!$employee) {
            return response()->json([
                'message' => 'Error al crear el empleado',
                'status' => 500
            ], 500);
        }

        // Devolver la respuesta de éxito
        return response()->json([
            'employee' => $employee,
            'status' => 201
        ], 201);
    }


    //funcion para obtener un solo estudiante
    public function show($id)
    {

        //se va a buscar en el modelo metodo find
        $employee = Employee::find($id);

        //si no encontraste es retorna un json
        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        //caso contrario vas a retornar esto
        $data = [
            'employee' => $employee,
            'status' => 200
        ];
        //esto se retrna al cliente
        return response()->json($data, 200);
    }


    //funcion para eliminar
    public function destroy($id)
    {

        $employee = Employee::find($id);

        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $employee->delete();
        $data = [
            'message' => 'Empleado eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }


    //con id se busca un dato
    // con request se agrega un nuevo dato

    public function update(Request $request, $id)
    {

        $employee = Employee::find($id);

        //si no se encuentra al estudiante
        if (!$employee) {
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'apellido' => 'required|max:255',
            'area' => 'required|max:255',
            'turno' => 'required|max:255',
        ]);

        //si el validator falla
        if (!$validator) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'status' => 400
            ];
            return response()->json($validator, 400);
        }

        //si los hace bien
        $employee->name = $request->name;
        $employee->apellido = $request->apellido;
        $employee->area = $request->area;
        $employee->turno = $request->turno;

        $employee->save();

        //estudiante actualizado

        $data = [
            'message' => 'Empleado actualizado',
            'employee' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    
public function updatePartial(Request $request, $id) {
    $employee = Employee::find($id);

    if (!$employee) {
        $data = [
            'message' => 'Empleado no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }

    // Validación de los datos
    $validator = Validator::make($request->all(), [
        'name' => 'max:255',
        'apellido' => 'email|unique:student,email,'.$id, // Asegúrate de excluir el email del estudiante actual
        'area' => 'digits:10',
        'turno' => 'in:English,Spanish,French'
    ]);

    // Si el validador falla
    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data, 400);
    }

    // Actualizar solo los campos recibidos
    if ($request->has('name')) {
        $employee->name = $request->name;
    }
    if ($request->has('apellido')) {
        $employee->apellido = $request->apellido;
    }
    if ($request->has('area')) {
        $employee->area = $request->area;
    }
    if ($request->has('turno')) {
        $employee->turno = $request->turno;
    }

    $employee->save();
    $data = [
        'message' => 'Empleado actualizado',
        'employee' => $employee,
        'status' => 200
    ];
    return response()->json($data, 200);
}
}
