<?php
namespace app\abstracts;


use app\interfaces\Action;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseAction implements Action
{
    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $response;
    }
}
