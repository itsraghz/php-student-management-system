<?php

/* Reference : https://logging.apache.org/log4php/quickstart.html */
include __DIR__ . '/../../../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

$logger = Logger::getLogger("main");
$logger->info("This is an informational message." . "<br/>");
$logger->warn("I'm not feeling so good..." . "<br/>");

?>
