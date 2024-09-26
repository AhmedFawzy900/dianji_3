<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Display all groups
    public function index()
    {
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    // Show form to create a new group
    public function create()
    {
        $users = User::all()->pluck('username', 'id');
        return view('groups.create', compact('users'));
    }

    // Store a new group
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_ids' => 'required|array',
        ]);

        Group::create([
            'name' => $request->name,
            'user_ids' => $request->user_ids, // Store the array of user IDs
        ]);

        return redirect()->route('groups.index')->with('success', 'Group created successfully.');
    }

    // Show form to edit a group
    public function edit(Group $group)
    {
         $allUsers = User::pluck('username', 'id')->toArray();
        // Pass group and users to the view
        return view('groups.edit', compact('group', 'allUsers'));
    }

    // Update a group
    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required',
            'user_ids' => 'required|array',
        ]);

        $group->update([
            'name' => $request->name,
            'user_ids' => $request->user_ids, // Update the array of user IDs
        ]);

        return redirect()->route('groups.index')->with('success', 'Group updated successfully.');
    }

    // Delete a group
    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Group deleted successfully.');
    }
}
