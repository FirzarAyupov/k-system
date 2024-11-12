<?php

namespace App\Infrastructure\Command;

use App\Application\Service\UserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add-user',
    description: 'Add a short description for your command',
)]
class AddUserCommand extends Command
{
    public function __construct(
        private readonly UserService $userService
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('login', InputArgument::REQUIRED, 'User login')
            ->addArgument('password', InputArgument::REQUIRED, 'User password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $login = $input->getArgument('login');
        $password = $input->getArgument('password');

        if (!$login && !$password) {
            $io->error(sprintf('You passed an argument'));
        }

        $this->userService->addUser($login, $password);

        return Command::SUCCESS;
    }
}
