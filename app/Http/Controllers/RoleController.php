<?php

namespace App\Http\Controllers;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'role.index');
        $roles = Role::orderBy('id','desc')->get();
        return view("role.index",compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess', 'role.create');
        $permissions = Permission::get();
        return view('role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess', 'role.create');
        $request->validate([
            'name' => 'required|max:50|unique:roles,name',
            'slug' => 'required|max:50|unique:roles,name',
            'full_access' => 'required|in:yes,no',
        ]);
        //dd($request->all());

        $role = Role::create($request->all());
        if($request->get('permission')){
            $role->permissions()->sync($request->get('permission'));
        }

        return redirect()->route('role.index')->with('status_success', 'Rol guardado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
       $this->authorize('haveaccess', 'role.show');
         //return $role->permissions;
         $permission_role = [];
         foreach($role->permissions as $permission){
             $permission_role[] = $permission->id;
         }
         //dd($role->permissions());
         $permissions = Permission::get();
         return view('role.view', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('haveaccess', 'role.edit');
        //return $role->permissions;
        $permission_role = [];
        foreach($role->permissions as $permission){
            $permission_role[] = $permission->id;
        }
        //dd($role->permissions());
        $permissions = Permission::get();
        return view('role.edit', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('haveaccess', 'role.edit');
        //
        $request->validate([
            'name' => 'required|max:50|unique:roles,name,'.$role->id,
            'slug' => 'required|max:50|unique:roles,name,'.$role->id,
            'full_access' => 'required|in:yes,no',
        ]);
        //dd($request->all());

        $role->update($request->all());

        if($request->get('permission')){
            $role->permissions()->sync($request->get('permission'));
        }

        return redirect()->route('role.index')
                ->with('status_success', 'Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('haveaccess', 'role.destroy');

        $role->delete();
        

        return redirect()->route('role.index')
                ->with('status_success', 'Rol eliminado correctamente');
    }
}
