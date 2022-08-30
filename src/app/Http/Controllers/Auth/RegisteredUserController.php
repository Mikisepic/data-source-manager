<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return \Inertia\Response
   */
  public function create()
  {
    return Inertia::render('Auth/Register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
      'id' => Str::uuid()->toString(),
      'username' => $request->username,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
  }

  /**
   * Display information about registered user.
   *
   * @return \Inertia\Response
   */
  public function show()
  {
    $user = User::withCount('dataSources', 'collections', 'groups')->findOrFail(Auth::id());

    return Inertia::render('Views/Profile', [
      'data' => $user
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\DataSourceRequest  $request
   * @param  \App\Models\DataSource  $dataSource
   * @return \App\Http\Resources\DataSourceResource
   */
  public function update(Request $request, User $user)
  {
    $user->update($request->validated());
    return new UserResource($user);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\DataSource  $dataSource
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();
    return response()->noContent();
  }
}
