<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function addContent(Request $request)
    {
        if ($request->has('begin') && $request->has('end') && $request->has('place') && $request->has('content')) {
            $schedule = new Schedule();
            $schedule->addContent($request->input('begin'), $request->input('end'), $request->input('place'), $request->input('content'), $request->user());
            return redirect(route('home'));
        }
        return view('pages.error');
    }

    public function editContent(Request $request)
    {
        if ($request->has('begin') && $request->has('end') && $request->has('place') && $request->has('content') && $request->has('id')) {
            $schedule = new Schedule();
            $schedule->editContent($request->input('begin'), $request->input('end'), $request->input('place'), $request->input('content'), $request->user(), $request->input('id'));
            return redirect(route('home'));
        }
        return view('pages.error');
    }

    public function deleteContent(Request $request)
    {
        if ($request->has('id')) {
            $schedule = new Schedule();
            $schedule->deleteContent($request->input('id'), $request->user());
            return redirect(route('home'));
        }
        return view('pages.error');
    }
}
