<?php

namespace App\Traits;

trait HasApiResponse
{
    protected static $response = [
        'meta' => [
            'status'    => true,
            'code'      => 200,
            'message'   => ''
        ],
        'data' => []
    ];

    public function success($data = [], $message = "Successfully Sended")
    {
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public function error($data = [], $message = "Failed Sended", $code = 500)
    {
        self::$response['meta']['status']   = false;
        self::$response['meta']['code']     = $code;
        self::$response['meta']['message']  = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}

