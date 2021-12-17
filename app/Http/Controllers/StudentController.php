<?php

namespace App\Http\Controllers;
use App\Models\Gradebook;
use App\Http\Requests\CreateStudentRequest;



use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $gradebook= Gradebook::with('students')->findOrFail($id);


        return response()->json($gradebook);
    }

    public function store($id, CreateStudentRequest $request){
    $data= $request->validated();
    $gradebook=Gradebook::findOrfail($id);
    $student = $gradebook->students->create($data);

    return response()->json($student,201);

    }
}
