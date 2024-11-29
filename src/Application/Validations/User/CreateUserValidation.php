<?php

namespace App\Application\Validations\User;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class CreateUserValidation implements MiddlewareInterface
{
    public function __construct(
        private ResponseFactoryInterface $responseFactory,
        private LoggerInterface $logger
    ) {}
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->logger->info("sadasd");
        $response = $this->responseFactory->createResponse();
        $data = $request->getParsedBody();

        if ($data["email"] == null) {
            $response->getBody()->write("Email is required");
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
        return $handler->handle($request);
    }
}
