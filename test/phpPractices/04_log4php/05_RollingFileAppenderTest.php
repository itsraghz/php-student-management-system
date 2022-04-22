<?php

// Reference : http://click.accesstrade.co.id/log4php/site/docs/appenders/rolling-file.html

// Insert the path where you unpacked log4php
include __DIR__ . '/../../../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
Logger::configure('config-rolling-file.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('myRollingLogger');

for($i=0; $i<100000; $i++) {
  // Start logging
  $log->trace("[$i] My first message.");   // Not logged because TRACE < WARN
  $log->debug("[$i] My second message.");  // Not logged because DEBUG < WARN
  $log->info("[$i] My third message.");    // Not logged because INFO < WARN
  $log->warn("[$i] My fourth message.");   // Logged because WARN >= WARN
  $log->error("[$i] My fifth message.");   // Logged because ERROR >= WARN
  $log->fatal("[$i] My sixth message.");   // Logged because FATAL >= WARN
}

?>
