<?php

/*
 * This file is part of the Cilex framework.
 *
 * (c) Mike van Riel <mike.vanriel@naenius.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Maherio\Lyceum\Command;

use Maherio\Lyceum\Service\Csv\CsvFileReaderInterface;
use Maherio\Lyceum\Factory\LearningPathFactory;

use Cilex\Command\Command as CilexCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Example command for testing purposes.
 */
class GetLearningPathsCommand extends CilexCommand
{
    protected $command = 'lyceum:get_learning_paths';

    public function __construct(CsvFileReaderInterface $fileReader, LearningPathFactory $learningPathFactory) {
        $this->fileReader = $fileReader;
        $this->learningPathFactory = $learningPathFactory;

        return parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName($this->command)
            ->setDescription('Takes in students\' scores and outputs recommended learning paths')
            ->addArgument('student_scores', InputArgument::REQUIRED, 'Absolute path to a CSV file containing student test scores')
            ->addArgument('domain_order', InputArgument::OPTIONAL, 'Absolute path to a CSV file containing the domain order to study. Optional');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $studentScoresFilepath = $input->getArgument('student_scores');
        $domainOrderFilepath = $input->getArgument('domain_order');

        if(!$domainOrderFilepath) {
            //use the default domain order
            $domainOrderFilepath = __DIR__ . '/../../data/domain_order.csv';
        }

        $domainOrder = $this->fileReader->read($domainOrderFilepath);
        $studentScores = $this->fileReader->read($studentScoresFilepath);

        $learningPaths = $this->learningPathFactory->bulkCreate($studentScores, $domainOrder);

        foreach ($learningPaths as $learningPath) {
            //should probably be encapsulated in a csv writer
            $output->writeln(implode(',', $learningPath->toArray(5)));
        }
    }
}
