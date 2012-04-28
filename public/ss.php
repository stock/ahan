<?php
    $hostname="http://www.google.com/";
	$buf=OpenURL($hostname);
	echo $buf;

function OpenURL($url)
{
	$hostname=trim($url);
    if ($hostname)
    {
        $port="80";
        $connection=fopen($hostname,"r");
        if(!$connection) 
            echo "$errstr ($errno)<br>\n";
        else 
        {
            $buf="";
            while(!feof($connection))
                $buf.=fgets($connection,128);
        }
        if ($connection!=0) 
            fclose($connection); 
		return $buf;
	}
}

?> 
