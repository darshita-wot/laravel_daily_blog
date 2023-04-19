<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendPendingCommentEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-pending-comment-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all users who have pending approval of comments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $comments = Comment::select('blog_owner_id',DB::raw("count(*) as user_count"))->groupBy('blog_owner_id')->get();
        foreach ($comments as $comment) {
           
            $data['user_id'] = $comment->blog_owner_id;
            $data['name'] = $comment->name;
            $data['total_comments'] = $comment->user_count;
            $data['user'] = User::where('id',$data['user_id'])->whereNull('deleted_at')->first(['email','name']);
            $data['title'] = 'Pending Actions';
            $data['body'] = 'You have '.$data['total_comments'].' comments pending. Login here to approve it';
           
            if($data['total_comments'] > 10){
                // Mail::send('commentApproveMail', ['data' => $data], function ($message) use ($data) {
                //     $message->to($data['user']->email)->subject($data['title']);
                // });
            }
           
        }
    }
}