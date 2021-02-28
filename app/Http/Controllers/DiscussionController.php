<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BengkelDiscussion;
use App\BengkelDiscussionReply;

class DiscussionController extends Controller
{
    public function submitDiscussion(Request $request){
        $discussion = new BengkelDiscussion;
        $discussion->id_bengkel = $request->id_bengkel;
        $discussion->id_user = Auth::id();
        $discussion->message = $request->message;

        $discussion->save();

        return redirect('/bengkel/'.$request->id_bengkel.'/#pills-discuss');
    }

    public function submitReply(Request $request){
        $discussion = new BengkelDiscussionReply;
        $discussion->id_bengkel = $request->id_bengkel;
        $discussion->id_discussion = $request->id_discussion;
        $discussion->id_user = Auth::id();
        $discussion->message = $request->message;

        $discussion->save();

        return redirect('/bengkel/'.$request->id_bengkel.'/#pills-discuss');
    }

}
