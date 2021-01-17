<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Exception\PostNotFoundException;
use App\Domain\Post;
use App\Domain\PostRepositoryInterface;

class InMemoryPostRepository implements PostRepositoryInterface
{
    /** @var Post[]  */
    private array $posts = [];

    public function find(string $guid): Post
    {
        return $this->posts[$guid] ?? throw PostNotFoundException::forGuid($guid);
    }

    public function all(int $limit): array
    {
        return \array_slice($this->posts, 0, $limit);
    }

    public function persist(Post $post): void
    {
        $this->posts[$post->guid()] = $post;
    }
}
