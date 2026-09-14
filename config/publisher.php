<?php

return [

    'two_factor' => [
        'max_code_attempts' => (int) env('PUBLISHER_2FA_MAX_ATTEMPTS', 5),
        'attempt_window_minutes' => (int) env('PUBLISHER_2FA_ATTEMPT_WINDOW', 30),
    ],

];
