<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\LabelRequest;
use App\Http\Resources\LabelResource;
use App\Models\Label;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LabelResource::label(Label::where('user_id', Auth::id())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LabelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request->validated();
        $label = new Label;
        $label->title = $request->title;
        $label->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return new LabelResource($label);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());
        return new LabelResource($label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        $label->delete();
        return response()->noContent();
    }
}
