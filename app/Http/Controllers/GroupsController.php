<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Models\Group;
use App\Models\Permission;


class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('groups.index', [
            'groups' => Group::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create', [
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupCreateRequest $request)
    {
        $group = Group::create([
            'name' => $request->input('name'),
        ]);

        $group->permissions()->sync($request->input('permissions'));

        return redirect()->route('groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('groups.edit', [
            'group' => $group,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        $group->update([
            'name' => $request->input('name'),
        ]);

        $group->permissions()->sync($request->input('permissions', []));

        return redirect()->route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index');
    }
}
