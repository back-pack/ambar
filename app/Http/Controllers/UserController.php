<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(Auth::id());
        return view('model.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('model.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirm', 'same:password_confirm'],
            'password_confirm' => ['required', 'string', 'min:8'],
        ]);
        
        array_key_exists('is_admin', $request->all()) ? $attributes['is_admin'] = true : $attributes['is_admin'] = false;
        array_key_exists('is_active', $request->all()) ? $attributes['is_active'] = true : $attributes['is_active'] = false;

        $attributes['password'] = Hash::make($attributes['password']);
        
        User::create($attributes);

        return redirect(route('users.index'))->with('success','El usuario se creó correctamente.');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('model.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'required_with:password_confirm', 'same:password_confirm'],
            'password_confirm' => ['required', 'string', 'min:8'],
        ]);
        
        array_key_exists('is_admin', $request->all()) ? $attributes['is_admin'] = true : $attributes['is_admin'] = false;
        array_key_exists('is_active', $request->all()) ? $attributes['is_active'] = true : $attributes['is_active'] = false;
        
        if($attributes['password'] === '********') {
            $attributes['password'] = $user->password;
        } else {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        $user->update($attributes);

        return redirect(route('users.index'))->with('success', 'Los datos se actualizaron correctamente.');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success','El registro fue eliminado correctamente.');    
    }
}
