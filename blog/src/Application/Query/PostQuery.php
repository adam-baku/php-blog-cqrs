<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\ViewModel\PostView;
use App\Domain\PostRepositoryInterface;

class PostQuery
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function GetById(string $guid) : PostView
    {
        $post = $this->postRepository->find($guid);

        $postView = new PostView();
        $postView->title = $post->title();
        $postView->content = $post->content();
        $postView->filePath = $post->image()->path();

        return $postView;
    }

    public function GetByList(int $limit) : array
    {
        $posts = $this->postRepository->all($limit);

        $postViews = [];

        foreach ($posts as $post) {
            $postView = new PostView();
            $postView->title = $post->title();
            $postView->content = $post->content();
            $postView->filePath = $post->image()->path();

            $postViews[] = $postView;
        }

        return $postViews;
    }
}
