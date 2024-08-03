<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //listando los estudiantes
    public function index()
    {
        // Obtener todos los estudiantes
        $students = Student::all();

        // Devolver un JSON con la lista de estudiantes
        return response()->json([
            'students' => $students,
            'status' => 200
        ], 200);
    }

    //agregando un studiant
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'languaje' => 'required|in:English,Spanish,French'
        ]);

        // Si la validación falla
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        // Crear un nuevo estudiante
        $student = Student::create($request->all());

        // Si hay un error al crear el estudiante
        if (!$student) {
            return response()->json([
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ], 500);
        }

        // Devolver la respuesta de éxito
        return response()->json([
            'student' => $student,
            'status' => 201
        ], 201);
    }

//funcion para obtener un solo estudiante
public function show($id){

    //se va a buscar en el modelo metodo find
    $student = Student::find($id);

    //si no encontraste es retorna un json
    if (!$student) {
        $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }

    //caso contrario vas a retornar esto
    $data = [
        'student' => $student,
        'status' => 200
    ];
    //esto se retrna al cliente
    return response()->json($data, 200);
}

//funcion para eliminar
public function destroy($id){

    $student = Student::find($id);

    if (!$student) {
        $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
        ];
        return response() -> json($data, 404);
    }
    $student->delete();
    $data = [
        'message' => 'Estudiante eliminado',
        'status' => 200
    ];
    return response()->json($data, 200);

}

//con id se busca un dato
// con request se agrega un nuevo dato

public function update(Request $request, $id){

    $student = Student::find($id);

    //si no se encuentra al estudiante
    if (!$student) {
        $data = [
            'message'=>'Estudiante no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }
    $validator = Validator::make($request->all(),[
        'name'=>'required|max:250',
        'email' => 'required|email|unique:student',
        'phone' => 'required|digits:10',
        'languaje' => 'required|in:English,Spanish,French'
    ]);

    //si el validator falla
    if (!$validator) {
        $data = [
            'message'=>'Error en la validación de los datos',
            'status' => 400
        ];
        return response()->json($validator, 400);
    }

    //si los hace bien
    $student->name = $request->name;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->languaje = $request->languaje;
    
    $student->save();

    //estudiante actualizado

    $data = [
        'message'=>'estudiante actualizado',
        'student' => $student,
        'status'=> 200
    ];
    return response()->json($data, 200);
}

public function updatePartial(Request $request, $id) {
    $student = Student::find($id);

    if (!$student) {
        $data = [
            'message' => 'Estudiante no encontrado',
            'status' => 404
        ];
        return response()->json($data, 404);
    }

    // Validación de los datos
    $validator = Validator::make($request->all(), [
        'name' => 'max:255',
        'email' => 'email|unique:student,email,'.$id, // Asegúrate de excluir el email del estudiante actual
        'phone' => 'digits:10',
        'languaje' => 'in:English,Spanish,French'
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
        $student->name = $request->name;
    }
    if ($request->has('email')) {
        $student->email = $request->email;
    }
    if ($request->has('phone')) {
        $student->phone = $request->phone;
    }
    if ($request->has('languaje')) {
        $student->languaje = $request->languaje;
    }

    $student->save();
    // // Campos permitidos para actualización
    // $fields = ['name', 'email', 'phone', 'languaje'];

    // foreach ($fields as $field) {
    //     if ($request->has($field)) {
    //         $student->$field = $request->$field;
    //     }
    // }

    $data = [
        'message' => 'Estudiante actualizado',
        'student' => $student,
        'status' => 200
    ];
    return response()->json($data, 200);
}


}