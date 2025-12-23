<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.user.list', [
            'items' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create', [
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = User::create($this->getMassUpdateFields($request));
        if ($request->has('role')) {
            $user->assignRole($request->input('role'));
        }
        if ($request->hasFile('image')) {
            dd($request->file('image'));
        }
        $this->alert("success", "User has been added");
        return redirect(dashboard_route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.edit', [
            'item' => $user,
            'user_role' => $user->getRoleNames()->first(),
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        if (!$user) {
            $this->alert("warning", 'User not found');
        }
        $user->update($this->getMassUpdateFields($request));
        if ($request->has('role')) {
            $user->syncRoles([$request->input('role')]);
        }
        if ($request->hasFile('image')) {
            dd($request->file('image'));
        }
        $this->alert("success", "User has been edited");
        return redirect(dashboard_route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            alert("warning", 'User not found');
        }
        $user->delete();
        $this->alert("success", "User has been deleted");
        return redirect(dashboard_route('admin.users.index'));
    }

    private function getMassUpdateFields($request)
    {
        return array_merge(
            $request->only(['first_name', 'last_name', 'phone', 'email', 'about', 'is_active']),
            [
                'password' => Hash::make($request->input('password')),
                'is_active' => $request->filled('is_active') == 'on',
            ]
        );
    }
}
