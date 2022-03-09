<?php

namespace App\Http\Traits;

trait APIResponses {

    protected function baseResponse(int|string $status, string|null $message, mixed $data,  int $code)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ], $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Response for Success Requests
     * @param mixed $data
     * @param string $message
     * @param int $code
     *
     * @return Response
     */
    public function successResponse(mixed$data, string $message = null, int $code = 200)
    {
        return $this->baseResponse('success', $message, $data, $code);
    }

    /**
     * Response for Errors Requests
     * @param string $message
     * @param int $code
     *
     * @return Response
     */
    public function errorResponse(string $message = null, int $code)
    {
        return $this->baseResponse('error', $message, null, $code);
    }

    /**
     * Response for Errors Requests
     * @param mixed $data
     * @param string $message
     * @param int $code
     *
     * @return Response
     */
    public function errorResponseWithData(mixed $data, string $message = null, int $code)
    {
        return $this->baseResponse('error', $message, $data, $code);
    }
}
