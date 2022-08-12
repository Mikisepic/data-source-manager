<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataSourceRequest;
use App\Http\Resources\DataSourceResource;
use App\Models\DataSource;

class DataSourceController extends Controller
{
  public function index()
  {
    return DataSourceResource::collection(DataSource::all());
  }

  public function store(DataSourceRequest $request)
  {
    $dataSource = DataSource::create($request->validated());
    return new DataSourceResource($dataSource);
  }

  public function show(DataSource $dataSource)
  {
    return new DataSourceResource($dataSource);
  }

  public function update(DataSourceRequest $request, DataSource $dataSource)
  {
    $dataSource->update($request->validated());
    return new DataSourceResource($dataSource);
  }

  public function destroy(DataSource $dataSource)
  {
    $dataSource->delete();
    return response()->noContent();
  }
}
