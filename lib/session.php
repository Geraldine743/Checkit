<?php

session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'localhost:8888/checkit',
    'httponly' => true
]);

session_start();