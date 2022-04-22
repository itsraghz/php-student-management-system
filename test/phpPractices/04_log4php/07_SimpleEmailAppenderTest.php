<?php

/* Reference : https://logging.apache.org/log4php/quickstart.html */
/* https://logging.apache.org/log4php/docs/appenders/mail.html */

/**
* LoggerAppenderMail appends log events via email.

* This appender does not send individual emails for each logging requests but will collect them in a buffer and send them all in a single email once the appender is closed (i.e. when the script exists). Because of this, it may not appropriate for long running scripts, in which case LoggerAppenderMailEvent might be a better choice.

* Note: When working in Windows, make sure that the SMTP and smpt_port values in php.ini are set to the correct values for your email server (address and port).
 */

// Insert the path where you unpacked log4php
include __DIR__ . '/../../../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
Logger::configure('config-email-simple.xml');

// Fetch a logger, it will inherit settings from the root logger
$log = Logger::getLogger('mySimpleEmailLogger');

// Start logging
$log->trace("My first message.");   // Not logged because TRACE < WARN
$log->debug("My second message.");  // Not logged because DEBUG < WARN
$log->info("My third message.");    // Not logged because INFO < WARN
$log->warn("My fourth message.");   // Logged because WARN >= WARN
$log->error("My fifth message.");   // Logged because ERROR >= WARN
$log->fatal("My sixth message.");   // Logged because FATAL >= WARN

?>
