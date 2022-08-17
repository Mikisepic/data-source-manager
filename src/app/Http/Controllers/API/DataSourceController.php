<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataSourceRequest;
use App\Http\Resources\DataSourceResource;
use App\Models\DataSource;
use Inertia\Inertia;

class DataSourceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $sortBy = request('sort_by', 'created_at');
    if (!in_array($sortBy, ['id', 'title', 'expires_at'])) {
      $sortBy = 'created_at';
    }

    $sortDirection = request('sort_direction', 'desc');
    if (!in_array($sortDirection, ['asc', 'desc'])) {
      $sortDirection = 'desc';
    }

    $filled = array_filter(request()->only([
      'id',
      'title',
      'expires_at'
    ]));

    $dataSources = DataSource::when(
      count($filled) > 0,
      function ($query) use ($filled) {
        foreach ($filled as $column => $value) {
          $query->where($column, 'LIKE', '%' . $value . '%');
        }
      }
    )
      ->when(
        request('category', '') != '',
        function ($query) {
          $query->where('category', request('category'));
        }
      )
      ->when(request('search', '') != '', function ($query) {
        $query->where(function ($q) {
          $q->where('id', 'LIKE', '%' . request('search') . '%')
            ->orWhere('title', 'LIKE', '%' . request('search') . '%');
        });
      });

    $dataSourceCollection = DataSourceResource::collection($dataSources->orderBy($sortBy, $sortDirection)->paginate(20));

    return Inertia::render('Views/Library', [
      'data' => $dataSourceCollection
    ]);
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
