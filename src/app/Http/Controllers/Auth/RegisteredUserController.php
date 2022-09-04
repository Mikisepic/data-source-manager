<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $user = User::findOrFail($request->id);

    $validator = Validator::make($request->all(), [
      'email' => 'required|email|max:225|' . Rule::unique('users')->ignore($user->id),
      'first_name' => 'required|string|max:255',
      'last_name' => 'required|string|max:255',
      'username' => 'required|string|max:255',
      'location' => 'required|string|max:255',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    $user->fill([
      'first_name' => $request->first_name,
      'last_name' => $request->last_name,
      'username' => $request->username,
      'email' => $request->email,
      'location' => $request->location,
      'occupation' => $request->occupation,
      'academic_status' => $request->academic_status,
      'description' => $request->description
    ]);

    $user->save();

    return redirect()->route('profileShow');
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
