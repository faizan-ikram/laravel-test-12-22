<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataSourceRequest;
use App\Http\Resources\DataSourceResource;
use App\Http\Resources\DatastoreShowResource;
use App\Models\Datasource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DataSourceResource::collection(Datasource::latest()->paginate(10))->resource;
        return [
            "status" => 200,
            "data" => $data
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataSourceRequest $request)
    {
        $file = $request->file('file');
        $fileName = rand() . '-' . $file->getClientOriginalName();
        Storage::disk('private')->put($fileName,file_get_contents($file));

        $datasource = Datasource::create([
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'file'          =>  $fileName,
            'type'          =>  $request->type,
        ]);

        $data = new DataSourceResource($datasource);
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datasource = Datasource::find($id);
        $data = new DatastoreShowResource($datasource);
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
