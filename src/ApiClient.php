<?php

namespace IvankoTut\NotebookSdk;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use IvankoTut\NotebookSdk\Action\Alert;
use IvankoTut\NotebookSdk\Action\Note;
use IvankoTut\NotebookSdk\Action\Tag;
use IvankoTut\NotebookSdk\Action\TelegramUser;
use IvankoTut\NotebookSdk\Exception\ApiException;
use IvankoTut\NotebookSdk\Exception\ApiNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Клас для в з
 */
class ApiClient
{
    public const CONTENT_TYPE_JSON = 'application/json';
    public const API_USER_KEY_HEADER = 'api-key';

    /**
     * HTTP-клиент
     */
    private HttpClient $httpClient;
    private TelegramUser $telegramUser;
    private Tag $tag;
    private Note $note;
    private Alert $alert;

    public function __construct(
        string $apiBaseUrl,
        private readonly SerializerInterface $serializer,
        private readonly array $defaultHeaders = [],
    ) {
        $this->httpClient = new HttpClient([
            'base_uri' => str_ends_with($apiBaseUrl, '/') ? $apiBaseUrl : $apiBaseUrl . '/',
        ]);

        $this->tag = new Tag($this);
        $this->note = new Note($this);
        $this->alert = new Alert($this);
        $this->telegramUser = new TelegramUser($this);
    }

    public function telegramUser(): TelegramUser
    {
        return $this->telegramUser;
    }

    public function tag(): Tag
    {
        return $this->tag;
    }

    public function note(): Note
    {
        return $this->note;
    }

    public function alert(): Alert
    {
        return $this->alert;
    }

    /**
     * @throws ApiException
     */
    public function request(string $method, string $path, ?array $data = null, array $options = []): ResponseInterface
    {
        $method = strtoupper($method);
        $guzzleOptions = $this->prepareGuzzleOptions($method, $data, $options);
        $guzzleOptions[RequestOptions::HTTP_ERRORS] = false;

        try {
            $response = $this->httpClient->request($method, ltrim($path, '/'), $guzzleOptions);
        } catch (GuzzleException $e) {
            throw new ApiException('Ошибка запроса к API', $e);
        }

        if ($response->getStatusCode() >= 500) {
            throw new ApiException('Ошибка запроса к API');
        }

        if ($response->getStatusCode() === ApiNotFoundException::ERROR_CODE) {
            throw new ApiNotFoundException('Данные не найдены');
        }

        return $response;
    }

    public function requestWithFillModel(string $classToFill, string $method, string $path, ?array $data = null, array $options = []): object
    {
        $response = $this->request($method, $path, $data, $options);

        return $this->serializer->deserialize($response->getBody()->getContents(), $classToFill, 'json');
    }

    /**
     * @param $method
     * @param $data
     * @param array $options
     * @return array
     */
    private function prepareGuzzleOptions($method, $data, array $options): array
    {
        $guzzleOptions = [];
        if (isset($options['headers'])) {
            $guzzleOptions['headers'] = $options['headers'];
        } else {
            $guzzleOptions['headers'] = [];
        }

        $this->setDefaultHeader($guzzleOptions);

        if (!is_null($data)) {
            if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
                if (!isset($guzzleOptions['headers']['content-type'])) {
                    $guzzleOptions['headers']['content-type'] = self::CONTENT_TYPE_JSON;
                }
                if (is_array($data)) {
                    $guzzleOptions['json'] = $data;
                }
            } else {
                $guzzleOptions['query'] = $data;
            }
        }

        if (array_key_exists('api_user', $options) && null !== $options['api_user']) {
            $guzzleOptions['headers'][self::API_USER_KEY_HEADER] = $options['api-key'];
        }

        return $guzzleOptions;
    }

    private function setDefaultHeader(array &$guzzleOptions): void
    {
        foreach ($this->defaultHeaders as $header) {
            $guzzleOptions['headers'][$header['name']] = $header['value'];
        }
    }
}
