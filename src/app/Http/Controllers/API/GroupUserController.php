<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupUserRequest;
use App\Http\Resources\GroupUserResource;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;

class GroupUserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(GroupUserRequest $request, $id)
  {
    $groupUsers = GroupUser::where(function ($query) use ($id) {
      $query->where('group_id', $id);
    })->paginate(5);

    $groupUsers->each(function ($groupUser) {
      $groupUser->username = User::findOrFail($groupUser->user_id)->username;
    });

    return new GroupUserResource($groupUsers);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\GroupUser  $groupUser
   * @return \Illuminate\Http\Response
   */
  public function show(GroupUser $groupUser)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\GroupUser  $groupUser
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, GroupUser $groupUser)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\GroupUser  $groupUser
   * @return \Illuminate\Http\Response
   */
  public function destroy(GroupUser $groupUser)
  {
    //
  }
}
