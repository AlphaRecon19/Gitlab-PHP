<?php
/**
 * @author Chris Hilsdon <chris@koolserve.uk>
 */
require __DIR__ . '/../vendor/autoload.php';

//Check the connection to Gitlab running in the container
$connected = @fsockopen("localhost", 9980);
if (!$connected) {
    echo "Error: Can't connect to Gitlab in the container. \n";
    echo "Try running 'docker-compose up' before running again. \n";

    exit(1);
}