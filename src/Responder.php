<?php

declare(strict_types = 1);

namespace stereoflo\responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Responder
{
    /**
     * @param array<string, mixed> $data
     */
    public function success(array $data): JsonResponse
    {
        return $this->getResponse([
            'meta' => ['success' => true],
            'data' => $data,
        ], Response::HTTP_OK);
    }

    /**
     * @param array<array<string, mixed>> $data
     */
    public function successList(array $data, int $total, int $limit, int $offset): JsonResponse
    {
        return $this->getResponse([
            'meta' => [
                'success' => true,
                'total'   => $total,
                'limit'   => $limit,
                'offset'  => $offset,
            ],
            'data' => $data,
        ], Response::HTTP_OK);
    }

    public function created(string $id): JsonResponse
    {
        return $this->getResponse([
            'meta' => ['success' => true],
            'data' => ['id' => $id],
        ], Response::HTTP_CREATED);
    }

    public function updated(string $id): JsonResponse
    {
        return $this->getResponse([
            'meta' => ['success' => true],
            'data' => ['id' => $id],
        ], Response::HTTP_OK);
    }

    public function badRequest(string $message): JsonResponse
    {
        return $this->getResponse([
            'meta'  => ['success' => false],
            'error' => ['message' => $message],
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param array<string, string> $errors
     */
    public function validationFailed(array $errors): JsonResponse
    {
        return $this->getResponse([
            'meta'  => ['success' => false],
            'error' => [
                'message' => 'Validation failed',
                'details' => $errors,
            ],
        ], Response::HTTP_BAD_REQUEST);
    }

    public function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->getResponse([
            'meta'  => ['success' => false],
            'error' => ['message' => $message],
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->getResponse([
            'meta'  => ['success' => false],
            'error' => ['message' => $message],
        ], Response::HTTP_FORBIDDEN);
    }

    public function notFound(string $message = 'Not found'): JsonResponse
    {
        return $this->getResponse([
            'meta'  => ['success' => false],
            'error' => ['message' => $message],
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param array<string,mixed> $data
     */
    private function getResponse(array $data, int $status): JsonResponse
    {
        return new JsonResponse($data, $status);
    }
}
