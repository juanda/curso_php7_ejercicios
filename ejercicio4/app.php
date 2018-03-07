<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\AddCommand;
use App\Command\ListCommand;

$application = new Application();

$application->add(new AddCommand());
$application->add(new ListCommand());

$application->run();