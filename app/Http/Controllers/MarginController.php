<?php

namespace App\Http\Controllers;

use App\Margin;
use Illuminate\Http\Request;

class MarginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $margins = Margin::all();
        return view('model.margin.index', compact('margins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('model.margin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Margin::create($request->validate([
            'name' => ['required', 'max:30'],
            'profit' => ['required', 'numeric', 'min:0']
        ]));

        return redirect(route('margins.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function show(Margin $margin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function edit(Margin $margin)
    {
        return view('model.margin.edit', compact('margin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Margin $margin)
    {
        $margin->update($request->validate([
            'name' => ['required', 'max:30'],
            'profit' => ['required', 'numeric', 'min:0']
        ]));

        return redirect(route('margins.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Margin  $margin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Margin $margin)
    {
        $margin->delete();
        return redirect(route('margins.index'));
    }
}
