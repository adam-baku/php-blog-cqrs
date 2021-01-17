<?php
declare(strict_types=1);

namespace App\Domain;

interface PostRepositoryInterface
{
    public function find(string $id): Post;
    public function all(int $limit): array;
    public function persist(Post $post): void;
}
