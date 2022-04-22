<?php

/* Reference : https://logging.apache.org/log4php/quickstart.html */

// Insert the path where you unpacked log4php
include __DIR__ . '/../../../lib/apache-log4php-2.3.0/src/main/php/Logger.php';

// Tell log4php to use our configuration file.
Logger::configure('config-adv.xml');

/**
 * This is a classic usage pattern: one logger object per class.
 */
class Foo
{
    /** Holds the Logger. */
    private $log;

    /** Logger is instantiated in the constructor. */
    public function __construct()
    {
        // The __CLASS__ constant holds the class name, in our case "Foo".
        // Therefore this creates a logger named "Foo" (which we configured in the config file)
        $this->log = Logger::getLogger(__CLASS__);
    }

    /** Logger can be used from any member method. */
    public function go()
    {
        $this->log->info("We have liftoff.");
    }
}

$foo = new Foo();
$foo->go();

?>
