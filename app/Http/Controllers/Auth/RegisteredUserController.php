<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register', [
            'positions' => Position::where('name', '!=', 'Admin')->get()
        ]);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'id_position' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $path = 'storage/img/users/';
        $fontPath = public_path('dist/fonts/Nunito-ExtraBold.ttf');
        $char = strtoupper($request->name[0]);
        $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
        $dest = $path . $newAvatarName;

        $createAvatar = makeAvatar($fontPath, $dest, $char);
        $picture = $createAvatar == true ? $newAvatarName : '';

        $user = User::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_position' => $request->id_position,
            'picture' => $picture,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
