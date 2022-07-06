<?php

/**

 * PayPal Setting & API Credentials

 * Created by Raza Mehdi .

 */



return array(
    'client_id' =>'AU4_BktFl-ZP9ipBo3SOcAAGSvoUhtthqArEzVxAHGeF7IiutdVL8H34vtdqdX9ZbpCWv6x8PH4ZtgJB',
    'secret' => 'EIx7FwqiewAuigTzNHNHM1fh0kISUzbFSHrFTfXeppDp_FY19ELKpur8z8d44GwHqxwFUgGfFMkyjIeS',
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
