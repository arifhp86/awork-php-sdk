<?php

namespace Awork;

use Awork\Exceptions\AuthenticationException;
use Awork\Exceptions\NotFoundException;
use Exception;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class Api
{
    public HttpClient $httpClient;
    public Response $latestResponse;

    public const BASE_URL = 'https://api.awork.com/api';
    public const VERSION = 'v1';

    protected ?string $filter = null;
    protected ?string $order = null;

    public function __construct(private string $apiToken)
    {
        $this->httpClient = new HttpClient();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function get(string $endpoint, array $data = []): Response
    {
        $query = array_merge($this->getQueryParamaters(), $data);
        $this->latestResponse = $this->request()->get($endpoint, $query);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function post(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->post($endpoint, $data);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function put(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->put($endpoint, $data);

        return $this->response();
    }

    protected function request(): PendingRequest
    {
        return $this->httpClient->baseUrl(self::BASE_URL . '/' . self::VERSION)
            ->withToken($this->apiToken);
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws Exception
     */
    protected function response(): Response
    {
        if ($this->latestResponse->status() === 401) {
            throw new AuthenticationException($this->latestResponse->json('message.description'));
        }

        if ($this->latestResponse->status() === 404) {
            throw new NotFoundException(sprintf('The requested ressource %s could not be found.', $this->latestResponse->effectiveUri()));
        }

        if (! $this->latestResponse->successful()) {
            throw new Exception($this->latestResponse->json('description'));
        }

        return $this->latestResponse;
    }

    public function setFilter(string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function setOrder(string $order): self
    {
        $this->order = $order;

        return $this;
    }

    protected function getQueryParamaters(): array
    {
        $queryParameters = [];

        if (! is_null($this->filter)) {
            $queryParameters['filterby'] = $this->filter;
        }

        if (! is_null($this->order)) {
            $queryParameters['orderby'] = $this->order;
        }

        return $queryParameters;
    }
}
