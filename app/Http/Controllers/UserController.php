<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        // If the user is not logged in, redirect to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Get logged in user's messages
        $authenticatedUser = auth()->user();

        // Get all users except the authenticated user
        $users = User::where('users.id', '!=', $authenticatedUser->id)
            ->leftJoin('follows', function ($join) use ($authenticatedUser) {
                $join->on('users.id', '=', 'follows.following_id')
                    ->where('follows.follower_id', $authenticatedUser->id);
            })
            ->select('users.*', 'follows.id AS follow_id')
            ->get();

        return view('users.index', compact('users'));
    }

    public function follow(User $user)
    {
        // If the user is not logged in, redirect to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $authenticatedUser = auth()->user(); // Get the authenticated user
        $authenticatedUser->following()->attach($user->id); // Attach the authenticated user to the user to follow
        return redirect()->back();
    }

    public function unfollow(User $user)
    {
        // If the user is not logged in, redirect to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $authenticatedUser = auth()->user(); // Get the authenticated user
        $authenticatedUser->following()->detach($user->id); // Detach the authenticated user from the user to unfollow
        return redirect()->back();
    }
}
