<?php

if (!$loader = include __DIR__.'/vendor/autoload.php') {
    die('You must set up the project dependencies.');
}

//apparently this is necessary for the league/csv library to read csvs that were created on macs
if (!ini_get("auto_detect_line_endings")) {
    ini_set("auto_detect_line_endings", '1');
}

//should prob get some kind of DI container, but for now create dependencies here
$fileReader = new \Maherio\Lyceum\Service\Csv\CsvFileReader;
$domainFactory = new \Maherio\Lyceum\Factory\DomainFactory;
$gradeLevelFactory = new \Maherio\Lyceum\Factory\GradeLevelFactory;
$unitOfStudyFactory = new \Maherio\Lyceum\Factory\UnitOfStudyFactory;
$studentFactory = new \Maherio\Lyceum\Factory\StudentFactory($domainFactory, $gradeLevelFactory, $unitOfStudyFactory);
$gradeFactory = new \Maherio\Lyceum\Factory\GradeFactory($gradeLevelFactory, $domainFactory);
$learningPathFactory = new Maherio\Lyceum\Factory\LearningPathFactory($studentFactory, $gradeFactory);

$app = new \Cilex\Application('Lyceum');

$app->command(new \Cilex\Command\GreetCommand());

$app->command(new \Maherio\Lyceum\Command\GetLearningPathsCommand($fileReader, $learningPathFactory));

$app->run();
