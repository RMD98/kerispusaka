<?php

function fire_and_forget($url, $payload)
{
    $payload = json_encode($payload);
    $parts = parse_url($url);

    // Force HTTPS wrapper
    $host = 'ssl://' . $parts['host'];
    $port = $parts['port'] ?? 443;

    $fp = fsockopen($host, $port, $errno, $errstr, 10);

    if (!$fp) {
        logger("FF ERROR: $errstr");
        return false;
    }

    $headers  = "POST " . $parts['path'] . " HTTP/1.1\r\n";
    $headers .= "Host: " . $parts['host'] . "\r\n";
    $headers .= "Content-Type: application/json\r\n";
    $headers .= "Content-Length: " . strlen($payload) . "\r\n";
    $headers .= "Connection: Close\r\n\r\n";

    fwrite($fp, $headers . $payload);
    fclose($fp);
}
