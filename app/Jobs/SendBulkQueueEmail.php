<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public    $timeout = 7200;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $details )
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $input['subject'] = $this->details['subject'];

        User::query()
            ->chunkById( 500, function ( $users ) use ( $input ) {
                foreach ( $users as $user )
                {
                    $input['email'] = $user->email;
                    $input['name']  = $user->name;
                    Mail::send( 'email', [], function ( $message ) use ( $input ) {
                        $message->to( $input['email'], $input['name'] )
                                ->subject( $input['subject'] );
                    } );
                }
            } );

    }
}
