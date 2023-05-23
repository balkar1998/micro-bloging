<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    // message and messages as a parameter for using base of post

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'content' => 'required|max:500',
            'media' => 'file|mimes:jpeg,png,gif,webp,mp4,ogv,webm|max:20000' // 20MB
        ]);
    
        // Create a new message
        $message = new Message();
        $message->content = $validatedData['content'];
        
        // media
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $filePath = $file->store('media', 'public'); // Store the file in the 'public' disk under the 'media' directory
            $message->media = $filePath;
        }

        // user_id
        $message->user_id = auth()->user()->id;
    
        // Save the message
        $message->save();

        // Redirect to the messages index
        return redirect()->route('messages.index');
    }

    public function index()
    {
        // If the user is not logged in, redirect to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Get logged in user's messages
        $messages = Message::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('messages.index', compact('messages')); // compact('messages') is the same as ['messages' => $messages]
    }

    public function show($id)
    {
        // If the user is not logged in, redirect to the login page
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Get the message with the given id
        $authenticatedUser = User::find($id);
        $followedUsers = $authenticatedUser->followers()->pluck('users.id'); // Get the ids of the users that the authenticated user follows

        // Get the messages of the users that the authenticated user follows
        $messages = Message::whereIn('user_id', $followedUsers)
                    ->orderBy('created_at', 'desc')   
                    ->get();

        return view('messages.index', compact('messages'));
    }

}
