<?php

namespace Genesis\Response;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse as HttpJsonResponse;
use InvalidArgumentException;

class JsonResponse extends HttpJsonResponse
{
    /**
     * {@inheritdoc}
     */
    public function setData($data = [])
    {
        if (isset($data['data']) && $data['data'] instanceof LengthAwarePaginator) {
            $this->original = $data;
            $pagination = $data['data'];
            $this->data = json_encode([
                'data' => $pagination->items(),
                'links' => [
                    'first' => $pagination->url(1),
                    'last' => $pagination->url($pagination->lastPage()),
                    'prev' => $pagination->previousPageUrl(),
                    'next' => $pagination->nextPageUrl(),
                ],
                'meta' => [
                    'message' => $data['meta']['message'] ?? '',
                    'current_page' => $pagination->currentPage(),
                    'from' => $pagination->firstItem(),
                    'last_page' => $pagination->lastPage(),
                    'path' => $pagination->path(),
                    'per_page' => $pagination->perPage(),
                    'to' => $pagination->lastItem(),
                    'total' => $pagination->total(),
                ],
            ], $this->encodingOptions);

            if (!$this->hasValidJson(json_last_error())) {
                throw new InvalidArgumentException(json_last_error_msg());
            }

            return $this->update();
        }

        return parent::setData($data);
    }
}
