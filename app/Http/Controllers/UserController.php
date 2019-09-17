<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\UserRepository;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(User::class, 'user');
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
     * @param  StoreUserRequest  $request
     * @return UserRepository $userRepo
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, UserRepository $userRepo)
    {
        $userRepo->create($request);
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
     * Update a resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @param UserRepository $userRepo
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, UserRepository $userRepo, $id)
    {
        $userRepo->update($request, $id);
        return redirect(route('users.index'))->with('success', 'Los datos se actualizaron correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserRepository $userRepo
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRepository $userRepo, $id)
    {
        $userRepo->delete($id);
        return redirect(route('users.index'))->with('success','El registro fue eliminado correctamente.');
    }
}
