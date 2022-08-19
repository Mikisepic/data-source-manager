<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CollectionRequest;
use App\Http\Resources\CollectionResource;
use App\Models\Collection;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CollectionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $collections = CollectionResource::collection(
      Collection::withCount('dataSources')
        ->latest()
        ->paginate(20)
    );

    return Inertia::render('Views/Collections', [
      'data' => $collections
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\CollectionRequest  $request
   * @return \App\Http\Resources\CollectionResource
   */
  public function store(CollectionRequest $request)
  {
    $collection = Collection::create([
      'id' => Str::uuid()->toString(),
      ...$request->validated()
    ]);
    return new CollectionResource($collection);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Collection  $collection
   * @return \App\Http\Resources\CollectionResource
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
   * @return \App\Http\Resources\CollectionResource
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
