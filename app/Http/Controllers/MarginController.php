<?php

namespace App\Http\Controllers;

use App\Margin;
use App\Repositories\MarginRepository;
use App\Http\Requests\MarginRequest;
use Illuminate\Http\Request;

class MarginController extends Controller
{
    private $repository;

    public function __construct(MarginRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $margins = $this->repository->all();
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
    public function store(MarginRequest $request)
    {
        $margin = $this->repository->create($request);

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
    public function update(MarginRequest $request, Margin $margin)
    {
        $margin = $this->repository->update($request, $margin);

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
        $this->repository->delete($margin);

        return redirect(route('margins.index'));
    }
}
