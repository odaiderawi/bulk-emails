<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendBulkMailController extends Controller
{
    public function index()
    {
        return view( 'send_email_form' );
    }

    public function sendBulkMail( Request $request )
    {
        $request->validate( [ 'subject' => 'string|required' ] );

        $details = [
            'subject' => $request->input( 'subject' ),
        ];

        // send all mail in the queue.
        $job = ( new \App\Jobs\SendBulkQueueEmail( $details ) )
            ->delay(
                now()
                    ->addSeconds( 2 )
            );

        dispatch( $job );

        echo "Emails send successfully in the background, feel free to close the browser";

    }
}
