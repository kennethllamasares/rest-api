<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\AddUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $validatedData = $request->only(['first_name', 'last_name', 'username', 'password']);

        $validatedData['password'] = md5($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json([
            'success'=> true,
            'userId' => $user->id
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\UpdateUserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->only(['first_name', 'last_name', 'username']);

        if($request->filled('password')) {
            $validatedData['password'] = md5($request->password);
        }

        $user->update($validatedData);
        
        return response()->json(['success'=> true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['success'=> true]);
    }
}
