<?php
require_once 'city.php';

foreach($cities as $city)
{
    
    $city['did'].PHP_EOL;
    switch ($city['did'])
    {
        case 1:            
            echo strtolower($city['cname']).PHP_EOL;
            break;
                 
    }
    
}



/*
for($i=1; $i<=25; $i++)
{
    echo 
}
*/