<?php

class ApiHelper
{

    public static function errorHandler(Exception $e)
    {
        $env = (app()->environment() === 'local') ?
            [
                'code'   => $e->getCode(),
                'message'   => $e->getMessage(),
                'line'   => $e->getLine(),
                'file'   => $e->getFile()
            ]
            :
            ['message' => 'An error occurred!'];

        return response()->json($env, 500);
    }

}