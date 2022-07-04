<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
//use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user){
        $friends = $user->getFriends();
//        $friends->find()
//        dd($friends);/
        $user->load('posts');
        return Inertia::render('Users/Show', [
            "user" => $user,
            "friendsCount" => $user->getFriendsCount(),
            "isFriend" => $friends->contains('id', Auth::user()->id)
        ]);
    }

    public function me(){
        $friends = Auth::user()->getFriends();
//        $friends->find()
//        dd($friends);/
        Auth::user()->load('posts');
        return Inertia::render('Users/Me', [
            "user" => Auth::user(),
            "friendsCount" => Auth::user()->getFriendsCount(),
        ]);
    }

    public function addFriend(Request $request){
        $friend = User::query()->findOrFail( $request->user_id );
//        dd($friend);
        $request->user()->befriend( $friend );
        $friend->acceptFriendRequest( $request->user());

        return redirect()->back();
    }
    public function removeFriend(Request $request){
        $friend = User::query()->findOrFail( $request->user_id );
//        dd($friend);
        $request->user()->unfriend( $friend );

        return redirect()->back();
    }
}
