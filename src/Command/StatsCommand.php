<?php

namespace App\Command;

use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:stats',
    description: 'Fetch and display statistical data',
)]
class StatsCommand extends Command
{
    public function __construct(private UserRepository $UserRepository)
    {
        parent::__construct();
                
        $TotalNumberUser = $this->UserRepository->findAll();

    }

    protected function configure(): void
    {
        $this
            ->addArgument('user', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $TotalNumberUser = $input->getArgument('user');

        if ($TotalNumberUser) {
            $io->note(sprintf('You passed an argument: %s', $TotalNumberUser));
        }


        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    
    }
}
