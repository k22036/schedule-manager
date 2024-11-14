<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'begin',
        'end',
        'place',
        'content',
        'user_id',
    ];

    /**
     * Fetch the contents by user
     *
     * @param User $user
     * @return array
     */
    public function fetchContents($user)
    {
        $contents = Schedule::where('user_id', $user->user_id)->get();
        return $contents;
    }

    /**
     * Fetch the contents by id and user
     *
     * @param int $id
     * @param User $user
     * @return array
     */
    public function fetchContent($id, $user)
    {
        $content = Schedule::where('id', $id)->where('user_id', $user->user_id)->get();
        return $content[0];
    }

    /**
     * Add content to the room
     *
     * @param timestamp $begin
     * @param timestamp $end
     * @param string $place
     * @param string $content
     * @param array<string, string> $user
     * @return void
     */
    public function addContent($begin, $end, $place, $content, User $user)
    {
        $schedule = new Schedule();
        $schedule->begin = $begin;
        $schedule->end = $end;
        $schedule->place = $place;
        $schedule->content = $content;
        $schedule->user_id = $user['user_id'];

        $schedule->save();
    }

    /**
     * Edit content to the room
     *
     * @param timestamp $begin
     * @param timestamp $end
     * @param string $place
     * @param string $content
     * @param array<string, string> $user
     * @param int $id
     * @return void
     */
    public function editContent($begin, $end, $place, $content, User $user, $id)
    {
        $schedule = Schedule::where('id', $id)->where('user_id', $user['user_id'])->get();
        $schedule = $schedule[0];
        $schedule->begin = $begin;
        $schedule->end = $end;
        $schedule->place = $place;
        $schedule->content = $content;

        $schedule->save();
    }

    /**
     * Delete contents by id and user
     * 
     * @param array<string, string> $user
     * @return void
     */
    public function deleteContent($id, User $user)
    {
        $schedule = Schedule::where('id', $id)->where('user_id', $user['user_id'])->get();
        $schedule = $schedule[0];
        $schedule->delete();
    }
}
