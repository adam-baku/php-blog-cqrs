<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Common\CommandHandlerInterface;
use App\Domain\Post;
use App\Domain\PostRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AddPostCommandHandler implements MessageHandlerInterface, CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(AddPostCommand $command): void
    {
        $post = new Post(
            $command->guid,
            $command->title,
            $command->content
        );

        $this->postRepository->persist($post);
    }
}
