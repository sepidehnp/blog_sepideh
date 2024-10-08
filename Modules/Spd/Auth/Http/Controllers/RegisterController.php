<?php
namespace Spd\Auth\Http\Controllers;

use Spd\Share\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Spd\Auth\Http\Requests\RegisterRequest;
use Spd\Auth\Services\RegisterService;

class RegisterController extends Controller
{
    public function view()
    {
        return view('Auth::register');
    }
    public function register(RegisterRequest $request, RegisterService $registerService)
    {
        $user = $registerService->generateUser($request);

        auth()->loginUsingId($user->id);

        event(new Registered($user));

        return redirect()->route('home.index');
    }
}
