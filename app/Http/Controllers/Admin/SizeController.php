<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSizeRequest;
use App\Http\Requests\UpdateSizeRequest;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.sizes.index')->with([
            'sizes' => Size::query()->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddSizeRequest $request)
    {
        //
        if ($request->validated()) {
            Size::query()->create($request->validated());
            return redirect()->route('admin.sizes.index')->with([
                'success' => 'Size has been added Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
        return view('admin.sizes.edit')->with([
            'size' => $size
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, Size $size)
    {
        //
        if ($request->validated()) {
            $size->update($request->validated());
            return redirect()->route('admin.sizes.index')->with([
                'success' => 'Size has been updated Successfully'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index')->with([
            'success' => 'Size has been deleted Successfully'
        ]);
    }
}
