<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('sessions.create');
    }

    /**
     * @param StoreSessionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSessionRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => Str::lower($request->email),
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('users.show', auth()->user())->with('notice', 'ログインしました。');
        } else {
            return back()->with('notice', 'メールアドレスまたはパスワードが間違っています。');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('sessions.create')->with('notice', 'ログアウトしました。');
    }
}
