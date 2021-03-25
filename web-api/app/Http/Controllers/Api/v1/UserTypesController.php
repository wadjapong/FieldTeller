<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\UserTypes;
use App\Http\Resources\UserTypes as UserTypesResource;

class UserTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = UserTypes::with('permissions')->get();

        return new UserTypesResource($types);
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
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string',
            'permission_id'=> 'required|integer'
        ]);

        $type = $request->isMethod('put') ?
        UserTypes::findOrFail($request->input('id')) : new UserTypes;

        $type->name = $request->input('name');
        $type->permission_id = $request->input('permission_id');
        $dist->approval_status = $request->input('approval_status');
        $dist->decline_reason = $request->input('decline_reason');

        if ($type->save()) {
            return new UserTypesResource($type);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $type = UserTypes::findOrFail($id);

        if ($type->delete()) {
            return new UserTypesResource($type);
        }
    }
}
