<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.user.list', [
            'items' => $users,
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        dd($request->all());
        $user = User::create($this->getMassUpdateFields($request));
        $user->assignRole($request->input('role'));
        if ($request->hasFile('image')) {
            dd($request->file('image'));
        }
        session()->flash("success", "User has been added");
        return redirect(dashboard_route('dashboard.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.edit', [
            'item' => $user,
            'role' => $user->getRoleNames()->first(),
            'roles' => Role::all()->pluck('name'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        dd($request->all());
        if ($user) {
            $user->update($this->getMassUpdateFields($request));
            if ($request->has('role')) {
                $user->syncRoles([$request->input('role')]);
            }
            session()->flash("success", "User has been edited");
        } else {
            session()->flash("warning", 'User not found');
        }
        return redirect(dashboard_route('dashboard.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user) {
            $user->delete();
            session()->flash("success", "User has been deleted");
        } else {
            session()->flash("warning", 'User not found');
        }
        return redirect(dashboard_route('dashboard.users.index'));
    }

    private function getMassUpdateFields($request)
    {
        return array_merge(
            $request->only(['name', 'phone', 'email', 'about', 'is_active']),
            [
                'password' => Hash::make($request->input('password')),
            ]
        );
    }

    public function profileUpdate(Request $request, User $user) 
    {
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->phone = $request->input("phone");
        $user->save();
        
        session()->flash("success", "Profile was updated");
        return redirect(dashboard_route('dashboard.profile'));
    }

    public function userUpdatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
        ]);
        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->input("password"));
            $user->save();
            session()->flash("success", "Password was updated");
        } else {
            session()->flash("error", "Password does not match");
        }
        
        return redirect(dashboard_route('dashboard.profile'));
    }
}
