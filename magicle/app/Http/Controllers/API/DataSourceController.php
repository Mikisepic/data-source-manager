<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataSourceRequest;
use App\Http\Resources\DataSourceResource;
use App\Models\DataSource;

class DataSourceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index()
  {
    return DataSourceResource::collection(
      DataSource::latest()->paginate(20)
    );
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\DataSourceRequest  $request
   * @return \App\Http\Resources\DataSourceResource
   */
  public function store(DataSourceRequest $request)
  {
    $dataSource = DataSource::create($request->validated());
    return new DataSourceResource($dataSource);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\DataSource  $dataSource
   * @return \App\Http\Resources\DataSourceResource
   */
  public function show(DataSource $dataSource)
  {
    return new DataSourceResource($dataSource);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\DataSourceRequest  $request
   * @param  \App\Models\DataSource  $dataSource
   * @return \App\Http\Resources\DataSourceResource
   */
  public function update(DataSourceRequest $request, DataSource $dataSource)
  {
    $dataSource->update($request->validated());
    return new DataSourceResource($dataSource);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\DataSource  $dataSource
   * @return \Illuminate\Http\Response
   */
  public function destroy(DataSource $dataSource)
  {
    $dataSource->delete();
    return response()->noContent();
  }
}
