<?php
declare(strict_types=1);

namespace App\UI\Http\Rest;

use App\Application\Command\AddPostCommand;
use App\Application\Query\PostQuery;
use App\Infrastructure\Validation\ImageValidator;
use App\Infrastructure\Validation\PostValidator;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class PostController extends AbstractController
{
    private PostQuery $postQuery;

    public function __construct(PostQuery $postQuery)
    {
        $this->postQuery = $postQuery;
    }

    public function getById(Request $request): Response
    {
        //$this->get('query.bus')->dispatch('guid');

        return $this->json($this->postQuery->GetById('guid'));
    }

    public function getList(Request $request): Response
    {
        //$this->get('query.bus')->dispatch(10);

        return $this->json($this->postQuery->GetByList(10));
    }

    public function addNewPost(Request $request, PostValidator $validator): Response
    {
        $postData = \json_decode($request->getContent(), true, flags: \JSON_THROW_ON_ERROR);
        $validator->validate($postData);

        $guid = Uuid::uuid4()->toString();
        $this->get('command.bus')->dispatch(new AddPostCommand($guid, $postData['title'], $postData['content']));

        return new Response("added new post {$guid}");
    }

    public function attachImage(Request $request, ImageValidator $validator): Response
    {
        return new Response("attach image");
    }

    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        $response = new JsonResponse();
        $response->setEncodingOptions(\JSON_HEX_QUOT);
        $response->setData($data);
        return $response;
    }

    public static function getSubscribedServices()
    {
        return \array_merge(parent::getSubscribedServices(), ['command.bus' => '?'.MessageBusInterface::class,]);
    }
}
