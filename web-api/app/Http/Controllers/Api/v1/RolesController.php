<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;
use App\Http\Resources\Roles as RoleResource;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_type)
    {
        $roles = Roles::with(['creator', 'approver'])->where('user_type', $user_type)->get();
        return new RoleResource($roles);
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
            'name'=> 'required'
        ]);

        $role = $request->isMethod('put') ? 
        Roles::findOrFail($request->input('id')) : new Roles;

        $role->name = $request->input('name');
        $role->user_type = $request->input('user_type');
        $role->approval_status = $request->input('approval_status');
        $role->decline_reason = $request->input('decline_reason');
        $role->creator_id = $request->input('creator_id');
        $role->approver_id = $request->input('approver_id');

        if ($role->save()) {
            return new RoleResource($role);
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
        $role = Roles::findOrFail($id);

        if ($role->delete()) {
            return new RoleResource($role);
        }
    }
}
