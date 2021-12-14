<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gradebook;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradebooks = Gradebook::all();

        return response()->json($gradebooks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gradebook = Gradebook::create([
            'name' => $request->get('name'),
            'user_id' => $request->get('user_id'),
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
    public function update(Request $request, $id)
    {
        $gradebook = Gradebook::findOrFail($id);
        $gradebook->update($request->all);

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
