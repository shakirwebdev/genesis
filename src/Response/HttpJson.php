<?php

namespace Genesis\Response;

use Illuminate\Http\JsonResponse;

trait HttpJson
{
    /**
     * Generic response.
     *
     * @param array $data
     * @param array $meta
     * @param int   $statusCode
     * @param array $headers
     * @param mixed $meta
     *
     * @return JsonResponse
     */
    public function json($data = null, $meta = [], int $statusCode = 200, $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'meta' => $meta], $statusCode, $headers);
    }

    /**
     * Response HTTP 200.
     *
     * @param array  $data
     * @param string $message
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function success($data = null, $message = 'Successful', $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'meta' => ['message' => $message]], 200, $headers);
    }

    /**
     * Response HTTP 500.
     *
     * @param array  $data
     * @param string $message
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function error($data = null, $message = 'System Error', $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'meta' => ['message' => $message]], 500, $headers);
    }

    /**
     * Response HTTP 404.
     *
     * @param array  $data
     * @param string $message
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function urlNotFound($data = null, $message = 'Url Not Found', $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'meta' => ['message' => $message]], 404, $headers);
    }

    /**
     * Response HTTP 422.
     *
     * @param array  $errors
     * @param string $message
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function validationError($errors = [], $message = 'Validation Error', $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => null, 'meta' => ['message' => $message, 'errors' => $errors]], 422, $headers);
    }

    /**
     * Response HTTP 404.
     *
     * @param array  $data
     * @param string $message
     * @param array  $headers
     *
     * @return JsonResponse
     */
    public function forbidden($data = null, $message = 'Forbidden', $headers = []): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'meta' => ['message' => $message]], 401, $headers);
    }
}
