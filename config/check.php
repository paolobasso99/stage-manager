<?php

return [

    //Config for the Guzzle client that checks the sites
    'guzzle' => [

        //Set the user agent that perform the checking
        'user_agent' => 'Workup Site Checker',

        //Set max connection time
        'connect_timeout' => 10,

    ],

    //Config for emails


    //Number of checks needed to send an email of bad response
    'response_attempts_to_notificate' => '5',

    //Number of checks needed to send the last
    //email of bad response and stop sending notifications
    'response_attempts_to_stop' => '20',

    //Number of checks needed to send an email of failed certificate check
    'certificate_attempts_to_notificate' => '5',

];
