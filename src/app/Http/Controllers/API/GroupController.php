<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Str;

class GroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
   */
  public function index()
  {
    $filled = array_filter(request()->only([
      'id',
      'title',
      'user_id',
    ]));

    $groups = Group::when(
      count($filled) > 0,
      function ($query) use ($filled) {
        foreach ($filled as $column => $value) {
          $query->where($column, 'LIKE', '%' . $value . '%');
        }
      }
    )
      ->when(request('search', '') !== '', function ($query) {
        $query->where(function ($q) {
          $q->where('id', 'LIKE', '%' . request('search') . '%')
            ->orWhere('title', 'LIKE', '%' . request('search') . '%')
            ->orWhere('user_id', 'LIKE', '%' . request('search') . '%');
        });
      });

    $groupCollection = GroupResource::collection(
      $groups->withCount('dataSources', 'members')
        ->latest('updated_at')
        ->paginate(20)
    );

    return $groupCollection;
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

    $user = User::find($request->user_id);
    $user->groupMembers()->attach($group);

    return new GroupResource($group);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Group  $group
   * @return \App\Http\Resources\GroupResource
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
