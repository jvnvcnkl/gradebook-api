<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradebookRequest;
use App\Http\Requests\UpdateGradebookRequest;
use Illuminate\Http\Request;
use App\Models\Gradebook;
use App\Models\User;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradebooks = Gradebook::with('user')->get();

        return response()->json($gradebooks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradebookRequest $request)
    {
        $user = User::with('gradebook')->findOrFail($request->get('user_id'));

        if ($user->gradebook) {
            return response()->json(['message' => "User already has a gradebook"], 400);
        }

        $gradebook = $user->gradebook()->create([
            'name' => $request->get('name'),
        ]);

        return response()->json($gradebook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gradebook = Gradebook::findOrFail($id);

        return response()->json($gradebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradebookRequest $request, $id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->update($request->all());

        return response()->json($gradebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->delete();

        return response()->json($gradebook);
    }
}
