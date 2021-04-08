<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('contact.index',compact('users'));
    }

    public function create()
    {
        return view('contact.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'email|required|unique:users'
        ]);
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('contact.edit',compact('user'));
    }

    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|unique:users,email,'.$user->id,
            'name' => 'string|required'
        ]);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if (!Hash::check($request->get('password'), $user->password)) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();
        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
