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
     * Generic response.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function respond(array $data) {
        return response()->json($data, $this->statusCode);
    }

    /**
     * Respond a Success message.
     *
     * @param  array  $data
     * @param  integer $statusCode
     * @return \Illuminate\Http\Response
     */
    public function respondSuccess($data, $statusCode = 200) {

        $this->statusCode = $statusCode;

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
    public function respondError($message = 'Not found!', $statusCode = 404) {

        $this->statusCode = $statusCode;

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
    public function respondServerError($message = 'Internal error', $statusCode = 500) {

        $this->statusCode = $statusCode;

        return $this->respond([
                'status_code' => $statusCode,
                'error' => [
                    'message' => $message,
                ]
            ]);
    }

}