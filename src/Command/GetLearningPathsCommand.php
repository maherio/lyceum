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

    protected function configure()
    {
        $this
            ->setName($this->command)
            ->setDescription('Takes in students\' scores and outputs recommended learning paths')
            ->addArgument('student_scores', InputArgument::REQUIRED, 'What are the student scores?')
            ->addArgument('domain_order', InputArgument::OPTIONAL, 'What is the domain order?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $studentScores = $input->getArgument('student_scores');
        $domainOrder = $input->getArgument('domain_order');

        if(!$domainOrder) {
            //get the default domain order
            $domainOrder = 'asdf';
        }

        var_dump($studentScores, $domainOrder);
        exit();

        $text = 'learning paths output';
        $output->writeln($text);
    }
}
