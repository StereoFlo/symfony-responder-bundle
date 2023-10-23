<?php

declare(strict_types = 1);

namespace stereoflo\responder\Tests;

use PHPUnit\Framework\TestCase;
use stereoflo\responder\Responder;
use Symfony\Component\HttpFoundation\Response;
use function array_keys;
use function json_decode;

class ResponderTest extends TestCase
{
    private Responder $responder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->responder = new Responder();
    }

    public function testSuccess(): void
    {
        $object   = ['id' => 42, 'name' => 'Foo'];
        $response = $this->responder->success($object);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame(['meta', 'data'], array_keys($content));
        $this->assertSame(['success' => true], $content['meta']);
        $this->assertSame($object, $content['data']);
    }

    public function testSuccessCollection(): void
    {
        $collection = [['id' => 42, 'name' => 'Foo']];
        $total      = 1;
        $limit      = 10;
        $offset     = 0;
        $response   = $this->responder->successList($collection, $total, $limit, $offset);
        $content    = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame(['meta', 'data'], array_keys($content));
        $this->assertSame(['success' => true, 'total' => $total,  'limit' => $limit, 'offset' => $offset], $content['meta']);
        $this->assertSame($collection, $content['data']);
    }

    public function testUpdated(): void
    {
        $id       = '1';
        $response = $this->responder->updated($id);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame(['meta', 'data'], array_keys($content));
        $this->assertSame(['success' => true], $content['meta']);
        $this->assertSame(['id' => $id], $content['data']);
    }

    public function testCreated(): void
    {
        $id       = '1';
        $response = $this->responder->created($id);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertSame(['meta', 'data'], array_keys($content));
        $this->assertSame(['success' => true], $content['meta']);
        $this->assertSame(['id' => $id], $content['data']);
    }

    public function testAccepted(): void
    {
        $id       = '1';
        $response = $this->responder->accepted($id);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_ACCEPTED, $response->getStatusCode());
        $this->assertSame(['meta', 'data'], array_keys($content));
        $this->assertSame(['success' => true], $content['meta']);
        $this->assertSame(['id' => $id], $content['data']);
    }

    public function testBadRequest(): void
    {
        $message  = 'Some error message';
        $response = $this->responder->badRequest($message);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testValidationFailed(): void
    {
        $message  = 'Validation failed';
        $errors   = ['key1' => 'error1', 'key2' => 'error2'];
        $response = $this->responder->validationFailed($errors);
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message, 'details' => $errors], $content['error']);
    }

    public function testUnauthorized(): void
    {
        $message  = 'Unauthorized';
        $response = $this->responder->unauthorized();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testForbidden(): void
    {
        $message  = 'Forbidden';
        $response = $this->responder->forbidden();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_FORBIDDEN, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testNotFound(): void
    {
        $message  = 'Not found';
        $response = $this->responder->notFound();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testMethodNotAllowed(): void
    {
        $message  = 'Method not allowed';
        $response = $this->responder->methodNotAllowed();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_METHOD_NOT_ALLOWED, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testInternalServerError(): void
    {
        $message  = 'Internal server error';
        $response = $this->responder->internalServerError();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testBadGateway(): void
    {
        $message  = 'Bad gateway';
        $response = $this->responder->badGateway();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_BAD_GATEWAY, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }

    public function testServiceUnavailable(): void
    {
        $message  = 'Service unavailable';
        $response = $this->responder->serviceUnavailable();
        $content  = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertSame(Response::HTTP_SERVICE_UNAVAILABLE, $response->getStatusCode());
        $this->assertSame(['meta', 'error'], array_keys($content));
        $this->assertSame(['success' => false], $content['meta']);
        $this->assertSame(['message' => $message], $content['error']);
    }
}
