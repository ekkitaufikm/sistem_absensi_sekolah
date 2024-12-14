<?php

use Carbon\Carbon;
use GuzzleHttp\Client;

function rupiah($amount) {
    return 'Rp. ' . number_format((float)$amount, 0, ",", ".");
}

