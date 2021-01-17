<?php
declare(strict_types=1);

namespace App\Application\Command;

use App\Common\CommandHandlerInterface;
use App\Common\ImageAttachment;
use App\Domain\PostRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class AttachImageToPostCommandHandler implements MessageHandlerInterface, CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(AttachImageToPostCommand $command): void
    {
        $post = $this->postRepository->find($command->postGuid);

        $post->attachImage(new ImageAttachment($command->imagePath));

        $this->postRepository->persist($post);
    }
}
