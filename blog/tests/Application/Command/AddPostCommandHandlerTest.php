<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\AddPostCommand;
use App\Application\Command\AddPostCommandHandler;
use App\Domain\Post;
use App\Domain\PostRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class AddPostCommandHandlerTest extends TestCase
{
    private $postRepositoryMock;

    protected function setUp(): void
    {
        $this->postRepositoryMock = $this->prophesize(PostRepositoryInterface::class);
        parent::setUp();
    }

    /**
     * @test
     */
    public function WillAddNewPostToRepository()
    {
        // given
        $addPostCommand = new AddPostCommand('some_id', 'some_title', 'some_content');

        //when
        $handler = new AddPostCommandHandler($this->postRepositoryMock->reveal());
        $handler->__invoke($addPostCommand);

        //then
        $this->postRepositoryMock->persist(Argument::type(Post::class))->shouldHaveBeenCalledOnce();
    }
}
