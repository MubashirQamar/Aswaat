<?php

/**

 * PayPal Setting & API Credentials

 * Created by Raza Mehdi .

 */



return array(
    'client_id' =>'AQajALW5chfp03ViPd4WDbPlBCPWIkF1BbqdLcc7zvEu56ckFr3s1XVt3LuObxKrbvkc4BWerJ0au9rp',
    'secret' => 'EAfYtBuyrSMs8QHxQKINybbn7TwVOrk1tRguaqWn81y5nfI5y7jPJIbkFnQ5rYPqrO-YuZ8oDaqC2IKs',
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 1000,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);
