<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $notificationsByUser = Notification::where(function ($query) {
      $query->where('user_id', request('user_id'));
    })->latest()->paginate(20);

    return new NotificationResource($notificationsByUser);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(NotificationRequest $request)
  {
    $notifcation =
      Notification::create([
        'id' => Str::uuid()->toString(),
        ...$request->validated()
      ]);

    return new NotificationResource($notifcation);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Notification  $notification
   * @return \Illuminate\Http\Response
   */
  public function show(Notification $notification)
  {
    return new NotificationResource($notification);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Notification  $notification
   * @return \Illuminate\Http\Response
   */
  public function destroy(Notification $notification)
  {
    $notification->delete();
    return response()->noContent();
  }
}
