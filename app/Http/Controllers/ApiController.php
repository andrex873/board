<?php

namespace Board\Http\Controllers;


class ApiController extends Controller {

    protected $statusCode;

    public function respond(array $data) {
        return response()->json($data, $this->statusCode);
    }

    public function respondSuccess ($data, $statusCode = 200) {

        $this->statusCode = $statusCode;

        return $this->respond([
                    'status_code' => $statusCode,
                    'data' => $data,
                ]);

    }

    public function respondNotFound ($message = 'Not found!', $statusCode = 404) {

        $this->statusCode = $statusCode;

        return $this->respond([
                    'status_code' => $statusCode,
                    'error' => [
                        'message' => $message,
                    ]
                ]);
    }

}