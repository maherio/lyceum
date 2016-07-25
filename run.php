<?php

if (!$loader = include __DIR__.'/vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

$app = new \Cilex\Application('Lyceum');

//list of commands
$app->command(new \Cilex\Command\GreetCommand());

$app->command(new \Maherio\Lyceum\Command\GetLearningPathsCommand);

$app->run();
