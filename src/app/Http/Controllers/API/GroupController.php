<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return GroupResource::collection(Group::all());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\GroupRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(GroupRequest $request)
  {

    $request->validated();
    $group = new Group;
    $group->title = $request->title;
    $group->owner_id = $request->user()->id;
    $group->save();

    return $group;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Group  $group
   * @return \Illuminate\Http\Response
   */
  public function show(Group $group)
  {
    return new GroupResource($group);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\GroupRequest  $request
   * @param  \App\Models\Group  $group
   * @return \Illuminate\Http\Response
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
