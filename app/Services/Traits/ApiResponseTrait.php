<?php

namespace App\Services\Traits;

use App\Http\Resources\Ghost\EmptyResource;
use App\Http\Resources\Ghost\EmptyResourceCollection;
use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

trait ApiResponseTrait
{
    /**
     * @var int
     */
    protected $httpStatusCode = 200;

    /**
     * @var int
     */
    protected $errorCode;


    /**
     * Set HTTP status code of the response.
     *
     * @param  int  $statusCode
     * @return self
     */
    public function setHTTPStatusCode($statusCode)
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * Sends a response invalid query (http 500) to the request.
     * Error Code = 40.
     *
     * @param  string  $message
     * @return JsonResponse
     */
    public function respondInvalidQuery($message = null)
    {
        return $this->setHTTPStatusCode(500)
                    ->setErrorCode(40)
                    ->respondWithError($message);
    }

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param message $message
     *
     * @return JsonResponse
     */
    protected function respondWithData($data = [], $message = '')
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ]);
    }

    /**
     * @param JsonResource $resource
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithIndex(JsonResource $resource, $meta = [], $message = null, $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        return $this->apiListResponse(
            [
                'success' => true,
                'data' => $resource,
                'meta'  => $meta,
                'message' => $message,
            ], $statusCode, $headers
        );
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return array
     */
    public function parseDataList($data = [], $statusCode = 200, $headers = [])
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'data'  => $data['data'] ?? null,
            'meta'  => $data['meta'] ?? null
        ];

        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiListResponse($data = [], $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        $result = $this->parseDataList($data, $statusCode, $headers);


        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }

    /**
     * @param JsonResource $resource
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResource(JsonResource $resource, $message = null, $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        return $this->apiResponse(
            [
                'success' => true,
                'data' => $resource,
                'message' => $message
            ], $statusCode, $headers
        );
    }

    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return array
     */
    public function parseGivenData($data = [], $statusCode = 200, $headers = [])
    {
        $responseStructure = [
            'success' => $data['success'],
            'message' => $data['message'] ?? null,
            'data'  => $data['data'] ?? null
        ];
        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }

        if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }

            if ($statusCode === 200) {
                $statusCode = 500;
            }
        }

        if ($data['success'] === false) {
            if (isset($data['error_code'])) {
                $responseStructure['error_code'] = $data['error_code'];
            } else {
                $responseStructure['error_code'] = 1;
            }
        }
        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiResponse($data = [], $statusCode = 200, $headers = [])
    {
        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        $result = $this->parseGivenData($data, $statusCode, $headers);


        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }

    /*
     *
     * Just a wrapper to facilitate abstract
     */

    /**
     * @param ResourceCollection $resourceCollection
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(ResourceCollection $resourceCollection, $message = null, $statusCode = 200, $headers = [])
    {

        // https://laracasts.com/discuss/channels/laravel/pagination-data-missing-from-api-resource

        return $this->apiResponse(
            [
                'success' => true,
                'data' => $resourceCollection->response()->getData()
            ], $statusCode, $headers
        );
    }

    /**
     * Respond with success.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondSuccess($message = '')
    {
        return $this->apiResponse(['success' => true, 'message' => $message]);
    }

    /**
     * Respond with created.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function respondCreated($data)
    {
        return $this->apiResponse($data, 201);
    }

    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContent($message = 'No Content Found')
    {
        return $this->apiResponse(['success' => false, 'message' => $message], 200);
    }

    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResource($message = 'No Content Found')
    {
        return $this->respondWithResource(new EmptyResource([]), $message);
    }
    /**
     * Respond with no content.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNoContentResourceCollection($message = 'No Content Found')
    {
        return $this->respondWithResourceCollection(new EmptyResourceCollection([]), $message);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondUnAuthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, 401);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param int $statusCode
     *
     * @param Exception|null $exception
     * @param bool|null $error_code
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = 400, Exception $exception = null, int $error_code = 1)
    {

        return $this->apiResponse(
            [
                'success' => false,
                'message' => $message ?? 'There was an internal error, Pls try again later',
                'exception' => $exception,
                'error_code' => $error_code
            ], $statusCode
        );
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }

    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondError($message, 404);
    }

    /**
     * Respond with internal error.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondInternalError($message = 'Internal Error')
    {
        return $this->respondError($message, 500);
    }

    protected function respondValidationErrors(ValidationException $exception)
    {
        return $this->apiResponse(
            [
                'success' => false,
                'message' => $exception->getMessage(),
                'errors' => $exception->errors()
            ],
            422
        );
    }
}