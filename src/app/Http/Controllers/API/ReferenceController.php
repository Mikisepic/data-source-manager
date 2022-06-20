<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReferenceRequest;
use App\Http\Resources\ReferenceResource;
use App\Models\Reference;
use App\Models\Collection;
use App\Models\User;
use App\Models\ReferenceMetaData;

class ReferenceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return ReferenceResource::collection(Reference::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\ReferenceRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validated();

    $reference = new Reference;
    $reference->title = $request->title;
    $reference->source = $request->source;
    $reference->hasPrice = $request->hasPrice;
    $reference->category = $request->category;
    $reference->owner_id = $request->user()->id;
    $reference->collection_id = $request->collection_id;
    $reference->save();

    $collection = Collection::find($request->collection_id);
    $collection->totalReferences = $collection->totalReferences + 1;
    $collection->save();


    $user = User::find($request->user()->id);
    $user->total_references = $user->total_references + 1;
    $user->save();

    $data = ReferenceMetaData::scrape($request->source);

    $metaData = new ReferenceMetaData;
    $metaData->title = $data['title'];
    $metaData->description = isset($data['description']) ? $data['description'] : null;
    $metaData->price = isset($data['product_price']) ? $data['product_price'] : null;
    $metaData->image = isset($data['image']) ? $data['image'] : null;
    $metaData->author = isset($data['author']) ? $data['author'] : null;
    $metaData->year_published = isset($data['year_published']) ? $data['year_published'] : null;
    $metaData->source = isset($data['source']) ? $data['source'] : null;
    $metaData->reference_id = $reference->id;
    $metaData->save();


    return $metaData;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Reference  $reference
   * @return \Illuminate\Http\Response
   */
  public function show(Reference $reference)
  {
    return new ReferenceResource($reference);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\ReferenceRequest  $request
   * @param  \App\Models\Reference  $reference
   * @return \Illuminate\Http\Response
   */
  public function update(ReferenceRequest $request, Reference $reference)
  {
    $reference->update($request->validated());
    return new ReferenceResource($reference);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Reference  $reference
   * @return \Illuminate\Http\Response
   */
  public function destroy(Reference $reference)
  {

    $collection = Collection::find($reference->collection_id);
    $collection->totalReferences = $collection->totalReferences - 1;
    $collection->save();

    $user = User::find($request->user()->id);
    $user->total_references = $user->total_references - 1;
    $user->save();

    $reference->delete();
    return response()->noContent();
  }
}
