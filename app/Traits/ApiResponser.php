<?php

namespace App\Traits;

trait ApiResponser {

    protected function successResponse( $data, $code=200){
        return response()->json( $data, $code);
    }

    protected function errorResponse( $message, $data=[], $code=500){
        return response()->json([
            'message' => $message,
            'data' => $data
        ],$code);
    }
}