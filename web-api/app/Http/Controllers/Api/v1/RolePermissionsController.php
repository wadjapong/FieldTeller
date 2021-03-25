<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RolePermissions;
use App\Http\Resources\RolePermissions as RolePermissionsResource;

class RolePermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role_id)
    {
        $roles = RolePermissions::where('role_id', $role_id)->with('permission')->get();
        return new RolePermissionsResource($roles);
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
            'role_id'=> 'required',
            'permissions'=> 'required|array',
        ]);
        
        foreach($request->permissions as $permission_id) {
            $obj = new RolePermissions;
            $exists = RolePermissions::where('role_id', $request->input('role_id'))
            ->where('permission_id', $permission_id)
            ->where('approval_status', 'accepted')
            ->count();
            if ($exists == 0) {
                $obj->role_id = $request->input('role_id');
                $obj->permission_id = $permission_id;
                $obj->approval_status = $request->input('approval_status');
                $obj->decline_reason = $request->input('decline_reason');
                $obj->save();
            }
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
        //
    }
}
