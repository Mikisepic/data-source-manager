<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;  
use App\Http\Controllers\Controller;

use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;


class CollectionController extends Controller
{


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return CollectionResource::collection(Collection::where('owner_id', Auth::id())->get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\CollectionRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CollectionRequest $request)
  {
    $request->validated();
    $collection = new Collection;
    $collection->title = $request->title;
    $collection->isPublic = $request->isPublic;
    $collection->owner_id = $request->user()->id;
    $collection->save();

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Collection  $collection
   * @return \Illuminate\Http\Response
   */
  public function show(Collection $collection)
  {
    return new CollectionResource($collection);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\CollectionRequest  $request
   * @param  \App\Models\Collection  $collection
   * @return \Illuminate\Http\Response
   */
  public function update(CollectionRequest $request, Collection $collection)
  {
    $collection->update($request->validated());
    return new CollectionResource($collection);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Collection  $collection
   * @return \Illuminate\Http\Response
   */
  public function destroy(Collection $collection)
  {
    $collection->delete();
    return response()->noContent();
  }
}
