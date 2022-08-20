<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  public function index()
  {
    $groups = GroupResource::collection(
      Group::withCount('dataSources')
        ->when(Auth::user()->id !== '', function ($query) {
          $query->where('user_id', 'LIKE', '%' . Auth::user()->id . '%');
        })
        ->latest()
        ->paginate(20)
    );

    return Inertia::render('Views/Groups/GroupsIndex', [
      'data' => $groups
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\GroupRequest  $request
   * @return \App\Http\Resources\GroupResource
   */
  public function store(GroupRequest $request)
  {
    $group = Group::create([
      'id' => Str::uuid()->toString(),
      ...$request->validated()
    ]);
    return new GroupResource($group);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Group  $group
   * @return \App\Http\Resources\GroupResource
   */
  public function show(String $id)
  {
    $group = Group::withCount('dataSources')->findOrFail($id);

    return Inertia::render('Views/Groups/GroupsShow', [
      'data' => $group
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\GroupRequest  $request
   * @param  \App\Models\Group  $group
   * @return \App\Http\Resources\GroupResource
   */
  public function update(GroupRequest $request, Group $group)
  {
    $group->update($request->validated());
    return new GroupResource($group);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Group  $group
   * @return \Illuminate\Http\Response
   */
  public function destroy(Group $group)
  {
    $group->delete();
    return response()->noContent();
  }
}
