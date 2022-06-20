<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ShareRequest;
use App\Http\Resources\ShareResource;
use App\Models\Share;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ShareResource::share(Share::where('user_id', Auth::id())->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ShareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request->validated();
        $share = new Share;
        $share->deadline = $request->deadline;
        $share->expires_at = $request->expires_at;
        $share->comment = $request->comment;
        $share->reference_id = $request->reference_id;
        $share->shared_with = $request->shared_with;
        $share->owner_id = $request->user()->id;
        $share->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        return new ShareResource($share);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ShareRequest  $request
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function update(ShareRequest $request, Share $share)
    {
        $share->update($request->validated());
        return new ShareResource($share);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        $share->delete();
        return response()->noContent();
    }
}
