<?php
declare(strict_types=1);

namespace App\UI\Cli;

use App\Application\Command\AddPostCommand;
use App\Infrastructure\Validation\PostValidator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AddPost extends Command
{
    protected static $defaultName = 'app:add-post';
    private PostValidator $validator;
    private MessageBusInterface $commandBus;

    public function __construct(PostValidator $validator, MessageBusInterface $commandBus, string $name = null)
    {
        parent::__construct($name);
        $this->validator = $validator;
        $this->commandBus = $commandBus;
    }

    protected function configure(): void
    {
        $this->setDescription('Add new post.');

        $this->addArgument('title', InputArgument::REQUIRED, 'The title of post.');
        $this->addArgument('content', InputArgument::REQUIRED, 'The content of post.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $postData = [
            'title' => $input->getArgument('title'),
            'content' => $input->getArgument('content')
        ];

        $this->validator->validate($postData);

        $guid = Uuid::uuid4()->toString();
        $this->commandBus->dispatch(new AddPostCommand($guid, $postData['title'], $postData['content']));

        $output->writeln('success');
        return Command::SUCCESS;
    }
}
