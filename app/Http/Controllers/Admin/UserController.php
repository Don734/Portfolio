<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.pages.user.list', [
            'items' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

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

    public function profileUpdatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:8',
            'password_confirmation' => 'min:8'
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
