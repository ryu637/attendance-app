<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\Candidate;
use App\Models\Participant;
use App\Models\Attendance;
class EventController extends Controller
{
    function store(Request $request)
    {
        // $filePath = 'app/events.json';

        // if(Storage::exists($filePath)) {
        //     $events = json_decode(Storage::get($filePath), true);
        // }else {
        //     $events = [];
        // }
        $event = Event::create([
            'title' => $request['title'],
            'description' => $request['description'] ?? null,
            'creator_user_id' => auth()->id() ?? null,
            'token' => Str::random(16),
        ]);

        \Log::info('Candidate data:', $request->candidate_date);
        // 複数日を受け取る
        if ($request->has('candidate_date')) {
            foreach ($request['candidate_date'] as $date) {
                Candidate::create([
                    'event_id' => $event->id,
                    'candidate_date' => $date,
                    // 'start_time' => $request['start_time'] ?? null,
                    // 'end_time' => $request['end_time'] ?? null,
                ]);
            }
        }
        // $newEvent = [
        //     'id' => count($events) + 1,
        //     'title' => $request['title'],
        //     'date' => $request['dates'],
        //     'description' => $request->description ?? null,
        //     'creator_user_id' => auth()->id() ?? null, // ログインしていなければ null
        //     'token' => Str::random(16),
        // ];

        // $events[] = $newEvent;

        // Storage::put($filePath, json_encode($events,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return response()->json(['token' => $event['token']]);
    }

    function showByToken($token)
    {
        // $filePath = 'app/events.json';
        // if(!Storage::exists($filePath)){
        //     return response()->json('error',404);
        // }

        // $events = json_decode(Storage::get($filePath), true);
        // $event = collect($events)->firstWhere('token',$token);
        $event = Event::with('Candidate')->where('token',$token)->first();

        return response()->json($event);
    }

    function storeParticipant(Request $request, $eventId)
{
    // $filePath = 'app/events.json'; // イベント保存と同じファイルに統一

    // if (!Storage::exists($filePath)) {
    //     return response()->json(["error" => "No events found"], 404);
    // }

    // $events = json_decode(Storage::get($filePath), true);

    // token に該当するイベントを探す
    // $index = collect($events)->search(fn($e) => $e['token'] == $token);
    // if ($index === false) {
    //     return response()->json(["error" => "Event not found"], 404);
    // }

    // 既存参加者数をカウントして +1
    // $participants = $events[$index]["participants"] ?? [];
    // $newId = count($participants) + 1;

    // $participant = [
    //     "id" => $newId,
    //     "name" => $request->name,
    //     "email" => $request->email ?? null,
    //     "attendance" => $request->attendance,
    //     "comment" => $request->comment ?? ""
    // ];

    // $events[$index]["participants"][] = $participant;

    // Storage::put($filePath, json_encode($events, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // return response()->json(["success" => true, "participant" => $participant]);
    $participant = Participant::create([
        'event_id' => $eventId,
        'name' => $request->name,
    ]);

    // 2. 出欠保存
    foreach ($request->attendance as $candidate_date => $status) {

        // 日付から candidate_id を取得
        $candidate = Candidate::where('event_id', $eventId)
                              ->where('candidate_date', $candidate_date)
                              ->first();

        if (!$candidate) continue;

        Attendance::create([
            'participant_id' => $participant->id,
            'candidate_id'   => $candidate->id,
            'status'         => $status, // yes/maybe/no
        ]);
    }

    return response()->json([
        'success' => true,
        'participant' => $participant,
    ]);


}

}