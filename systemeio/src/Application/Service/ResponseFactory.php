<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

use function get_class;
use function in_array;

class ResponseFactory
{
    private SerializerInterface $serializer;


    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function success(
        $response = [],
        array $context = [],
        int $status = Response::HTTP_OK,
        array $headers = []
    ): JsonResponse {
        $headers = array_merge($headers, ['Content-Type' => 'application/json; charset=utf-8']);
        $data = $this->serializer->serialize(['status' => 'success', 'response' => $response], 'json', $context);
        return new JsonResponse($data, $status, $headers, true);
    }

    public function error(
        array $response = [],
        int $status = Response::HTTP_BAD_REQUEST,
        array $headers = []
    ): JsonResponse {
        $headers = array_merge($headers, ['Content-Type' => 'application/json; charset=utf-8']);
        $data = $this->serializer->serialize(['status' => 'error', 'response' => $response], 'json');
        return new JsonResponse($data, $status, $headers, true);
    }
}
