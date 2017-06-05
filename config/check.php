<?php

return [

    //Config for the Guzzle client that checks the sites
    'guzzle' => [

        //Set the user agent that perform the checking
        'user_agent' => 'Workup Site Checker',

        //Set max connection time
        'connect_timeout' => 10,

    ],

    //Config for mails
    'notifications' => [

        'response' => [

            'notify_on_fail' => true,
            'notify_on_restore' => true,

            //Attempts
            'attempts_to_notify' => '5',
            'attempts_to_stop_notifications' => '20'

        ],

        'certificate' => [

            'notify_on_fail' => true,
            'notify_on_restore' => true,

            //Attempts
            'attempts_to_notify' => '5',
            'attempts_to_stop_notifications' => '20'

        ]

    ],

];
