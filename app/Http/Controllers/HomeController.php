<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function home(Request $request): View
    {
        $user = $request->user();

        $Schedule = new Schedule();
        $contents = $Schedule->fetchContents($user);

        return view('pages.home', ['contents' => $contents]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $id = $request->input('id');

        $Schedule = new Schedule();
        $content = $Schedule->fetchContent($id, $user);

        return view('pages.edit_task', ['content' => $content]);
    }

    public function render_content(Request $request)
    {
        $user = $request->user();
        $id = $request->input('id');

        $Schedule = new Schedule();
        $target_content = $Schedule->fetchContent($id, $user);
        $contents = $Schedule->fetchContents($user);

        return view('pages.home', ['contents' => $contents, 'target_content' => $target_content, 'active' => $id]);
    }
}
