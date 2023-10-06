<?php

namespace App\Traits;

trait FormatResponse
{
    /**
     * Format response trait.
     *
     * @param  $request
     * @return  ArrayObject
     */
    public function sendResponse($request)
    {
        $status = false;
        $message = '';
        $data = null;
        $pagination = null;
        $error = null;

        if (isset($request->status)) {
            $status = $request->status;
        }

        if (isset($request->message)) {
            $message = $request->message;
        }

        if (isset($request->data)) {
            $data = $request->data;
        }

        if (isset($request->pagination)) {
            $pagination = $request->pagination;
        }

        if (isset($request->error)) {
            $error = $request->error;
        }

        if ($status) {
            $statusCode = 200;
        } else {
            $statusCode = 422;
        }

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination,
            'error' => $error,
        ];

        return response()->json($result, $statusCode);
    }
}
