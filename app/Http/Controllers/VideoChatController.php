<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\VideoChatOffer;
use App\Events\VideoChatAnswer;
use App\Events\VideoChatICECandidate;

class VideoChatController extends Controller
{
//    public function initiateCall(Request $request)
//    {
//        // You may want to perform additional validation here.
//
//        $roomId = $request->input('room_id');
//        $callerId = $request->user()->id;
//
//        // Broadcast the call initiation event to the specific room.
//        broadcast(new \App\Events\CallInitiated($callerId, $roomId))->toOthers();
//
//        return response()->json(['message' => 'Call initiated successfully']);
//    }

    public function endCall(Request $request)
    {
        // You may want to perform additional validation here.

        $roomId = $request->input('room_id');
        $callerId = $request->user()->id;

        // Broadcast the call end event to the specific room.
        broadcast(new \App\Events\CallEnded($callerId, $roomId))->toOthers();

        return response()->json(['message' => 'Call ended successfully']);
    }

    public function initiateCall(Request $request)
    {
        // Validate the input
        $request->validate([
            'room_id' => 'required|string',
            'callee_id' => 'required|int',
            'offer' => 'required|array',
        ]);

        $roomId = $request->input('room_id');
        $callerId = $request->user()->id;
        $calleeId = $request->input('callee_id');
        $offer = $request->input('offer');

        // Send the offer to the callee
        event(new VideoChatOffer($callerId, $calleeId, $offer));

        return response()->json(['message' => 'Call initiated successfully']);
    }

    public function answerCall(Request $request)
    {
        // Validate the input
        $request->validate([
            'room_id' => 'required|string',
            'caller_id' => 'required|int',
            'answer' => 'required|array',
        ]);

        $roomId = $request->input('room_id');
        $callerId = $request->input('caller_id');
        $calleeId = $request->user()->id;
        $answer = $request->input('answer');

        // Send the answer to the caller
        event(new VideoChatAnswer($callerId, $calleeId, $answer));

        return response()->json(['message' => 'Call answered successfully']);
    }

    public function iceCandidate(Request $request)
    {
        // Validate the input
        $request->validate([
            'room_id' => 'required|string',
            'caller_id' => 'required|int',
            'candidate' => 'required|array',
        ]);

        $roomId = $request->input('room_id');
        $callerId = $request->input('caller_id');
        $calleeId = $request->user()->id;
        $candidate = $request->input('candidate');

        // Send the ICE candidate to the peer
        event(new VideoChatICECandidate($callerId, $calleeId, $candidate));

        return response()->json(['message' => 'ICE candidate sent successfully']);
    }
}
