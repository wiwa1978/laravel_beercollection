<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
        $this->middleware(['role:Admin']);
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id','DESC')->paginate(10);
        return view('backend.permissions.index')->with('permissions', $permissions);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $roles = Role::get(); //Get all roles

        return view('backend.permissions.create')->with('roles', $roles);
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
            'name'=>'required|max:40',
            'description'=>'required|max:150',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $request['name'];
        $permission->description = $request['description'];

        $roles = $request['roles'];


        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', $name)->first(); //Match input //permission to db record
                //dd($permission);
                $r->givePermissionTo($permission);
            }
        }
        return redirect('permissions')->with('success', 'Permission has been created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('backend.permissions.show', compact('permission'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {


        return view('backend.permissions.edit', compact('permission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
            'description'=>'required|max:150',
        ]);

        $input = $request->all();
        $permission->fill($input)->save();

             return redirect('permissions')->with('success', 'Permission has been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //Make it impossible to delete this specific permission
        if ($permission->name == "Admin") {
                return redirect()->route('permissions.index')->with('success', 'Permission cannot be deleted');
            }

            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission has been deleted successfully');

    }
}
