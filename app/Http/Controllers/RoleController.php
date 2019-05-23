<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
        $this->middleware(['role:Admin']);
    }

     public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(10);

        return view('backend.roles.index')->with('roles', $roles);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//Get all permissions

        return view('backend.roles.create', ['permissions'=>$permissions]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|unique:roles|max:20',
            'description'=>'required|max:150',
            'permissions' =>'required',
            ]
        );

        $name = strtolower($request['name']);
        $description = $request['description'];
        $permissions = $request['permissions'];

        $role = new Role([
            'name' => $name,
            'description' => $description
        ]);
        $role->save();


        //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', $permission)->firstOrFail();
         //Fetch the newly created role and assign permission
            $role = Role::where('name', $name)->first();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')->with('success','Role '. $role->name.' added successfully!');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('backend.roles.show',compact('role'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('backend.roles.edit', compact('role', 'permissions'));

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

    //Validate name and permission fields
        $request->validate([
            'name'=>'required|max:20|unique:roles,name,'.$role->id,
             'description'=>'required|max:150',
            'permissions' =>'required',
        ]);

        $role->name = strtolower($request['name']);
        $role->description = $request['description'];
        $role->save();

        $submittedPermissions = $request['permissions'];

        //$input = $request->except(['permissions']);
        //$permissions = $request['permissions'];
        //$role->fill($input)->save();

        $allPermissions = Permission::all();//Get all permissions

        foreach ($allPermissions as $permission) {
            $role->revokePermissionTo($permission); //Remove all permissions associated with role
        }

        foreach ($submittedPermissions as $permission) {
            $p = Permission::where('id', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        return redirect()->route('roles.index')->with('success','Role '. $role->name.' updated successfully!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success','Role '. $role->name.' deleted successfully!');



    }
}
