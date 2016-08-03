<?php

namespace Board\Http\Controllers;


class ApiController extends Controller {

    /**
     * HTTP status code for the response.
     *
     * @var integer
     */
    protected $statusCode;

    /**
     * JSONP name of the callback if present
     * @var string
     */
    protected $jsonpCallback;

    /**
     * Generic response.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function respond(array $data)
    {
        return ($this->jsonpCallback)
            ? "{$this->jsonpCallback}(" . json_encode($data) . ")"
            : response()->json($data, $this->statusCode);
    }

    /**
     * Respond a Success message.
     *
     * @param  array  $data
     * @param  integer $statusCode
     * @return \Illuminate\Http\Response
     */
    public function respondSuccess($data, $statusCode = 200, $jsonpCallback = null)
    {
        $this->statusCode = $statusCode;
        $this->jsonpCallback = $jsonpCallback;

        return $this->respond([
                'status_code' => $statusCode,
                'data' => $data,
            ]);
    }

    /**
     * Respond a resource not found error.
     *
     * @param  string  $message
     * @param  integer $statusCode
     * @return \Illuminate\Http\Response
     */
    public function respondError($message = 'Not found!', $statusCode = 404, $jsonpCallback = null)
    {
        $this->statusCode = $statusCode;
        $this->jsonpCallback = $jsonpCallback;

        return $this->respond([
                    'status_code' => $statusCode,
                    'error' => [
                        'message' => $message,
                    ]
                ]);
    }

    /**
     * Respond a server error.
     *
     * @param  string  $message
     * @param  integer $statusCode
     * @return \Illuminate\Http\Response
     */
    public function respondServerError($message = 'Internal error', $statusCode = 500, $jsonpCallback = null)
    {
        $this->statusCode = $statusCode;
        $this->jsonpCallback = $jsonpCallback;

        return $this->respond([
                'status_code' => $statusCode,
                'error' => [
                    'message' => $message,
                ]
            ]);
    }

}