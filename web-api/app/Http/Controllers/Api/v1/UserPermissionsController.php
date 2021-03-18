<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\UserPermissions;
use App\Http\Resources\UserPermissions as UserPermissionsResource;

class UserPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = UserPermissions::get();

        return UserPermissionsResource::collection($types);
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
            'action'=> 'required|string',
        ]);

        $perm = $request->isMethod('put') ?
        UserPermissions::findOrFail($request->input('id')) : new UserPermissions;

        $perm->action = $request->input('action');

        if ($perm->save()) {
            return new UserPermissionsResource($perm);
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
        // $type = UserPermissions::findOrFail($id);

        // if ($type->delete()) {
        //     return new UserPermissionsResource($type);
        // }
    }
}
