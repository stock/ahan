<?php

// webpage-tunnel server page 
// http://code.google.com/p/webpage-tunnel/
// base on http://webproxytunnel.sourceforge.net/
// this file under GPLv3

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["test"] != null) {
        $fp1 = fsockopen("www.google.com", 80);
        $fp2 = fsockopen("ssl://www.google.com", 443);
        $fin = fopen("php://input", "r");
        if ($fin == FALSE) {
            echo "Test Failed: Could not open input stream";
        }
        if ($fp1 == FALSE) {
            echo "Test Failed: Could not connect to google.com:80 allow_open must be on in php.ini";
        }
        if ($fp2 == FALSE) {
            echo "Test Failed: Could not connect to google.com:443 allow_open must be on in php.ini<br>";
            echo "SSL support not enable : Openssl may not be installed . fsockopen failed for ssl://";
        }
        if ($fp1 != FALSE && $fp2 != FALSE && $fin != FALSE){
            echo "Test Passed: Your server is perfect to run";
        }
    } else {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: http://www.google.com");
    }
} else {
    set_time_limit(300);
    error_reporting(0);
    $encKey = 20;
    $line = file_get_contents("php://input");
    $encryptEnable = substr($line, 0, 1);
    $line =  substr($line, 1);
    if($encryptEnable == "Y") {
        $line = deccrypt_string($line);
    }
    $hostport = substr($line,0, 61);
    $bodyData = substr($line, 61);
    $line = "";
    $host = substr($hostport, 0, 50);
    $port = substr($hostport, 50, 10);
    $issecure = substr($hostport, 60, 1);
    if($issecure == "Y") {
        $host = "ssl://".$host;
    }
    $fsok = fsockopen(trim($host), intval(trim($port)));
    if(FALSE == $fsok) {
        echo "Target Host not Found/Down";
        return;
    }
    fwrite($fsok, $bodyData );
    $port ="";
    $host ="";
    $hostport= "";
    $bodyData="";
    while ($line = fread($fsok, 25000)) {
        if($encryptEnable == "Y") {
            echo encrypt_string($line);
        } else {
            echo $line;
        }
    }
    fclose($fsok);
}

function encrypt_string($input)
{
    global $encKey;
    $line = "";
    for($i = 0; $i < strlen($input); $i++) {
        $line .= chr(ord($input[$i]) + $encKey);
    }
    return $line;
}
function deccrypt_string($input)
{
    global $encKey;
    $line = "";
    for($i = 0; $i < strlen($input); $i++){
        $line .= chr(ord($input[$i]) - $encKey);
    }
    return $line;
}
?>
