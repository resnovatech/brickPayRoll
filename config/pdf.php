<?php
return[
   


'font_path' => base_path('resources/fonts/'),
    'font_data' => [
       'bangla' => [
            'R'  => 'SolaimanLipi_20-04-07.ttf',    // regular font
            'B'  => 'SolaimanLipi_20-04-07.ttf',       // optional: bold font
            'I'  => 'SolaimanLipi_20-04-07.ttf',     // optional: italic font
            'BI' => 'SolaimanLipi_20-04-07.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,   
            'useKashida' => 75, 
        ],
         'banglabold' => [
            'R'  => 'SolaimanLipi_Bold_10-03-12.ttf',    // regular font
            'B'  => 'SolaimanLipi_Bold_10-03-12.ttf',       // optional: bold font
            'I'  => 'SolaimanLipi_Bold_10-03-12.ttf',     // optional: italic font
            'BI' => 'SolaimanLipi_Bold_10-03-12.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,   
            'useKashida' => 75, 
        ]
        // ...add as many as you want.
    ]
];