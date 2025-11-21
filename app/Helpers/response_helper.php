<?php

if (!function_exists('api_response')) {
    /**
     * Standard API response helper
     *
     * @param string $status
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function api_response($status = 'success', $data = null, $message = null, $code = 200)
    {
        $response = service('response');
        
        $responseData = [
            'status' => $status,
        ];
        
        if ($message !== null) {
            $responseData['message'] = $message;
        }
        
        if ($data !== null) {
            $responseData['data'] = $data;
        }
        
        return $response->setJSON($responseData)->setStatusCode($code);
    }
}

if (!function_exists('success_response')) {
    /**
     * Success response helper
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function success_response($data = null, $message = null, $code = 200)
    {
        return api_response('success', $data, $message, $code);
    }
}

if (!function_exists('error_response')) {
    /**
     * Error response helper
     *
     * @param string $message
     * @param mixed $errors
     * @param int $code
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function error_response($message, $errors = null, $code = 400)
    {
        $data = $errors !== null ? ['errors' => $errors] : null;
        return api_response('error', $data, $message, $code);
    }
}

if (!function_exists('not_found_response')) {
    /**
     * Not found response helper
     *
     * @param string $message
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function not_found_response($message = 'Resource not found')
    {
        return error_response($message, null, 404);
    }
}

if (!function_exists('validation_error_response')) {
    /**
     * Validation error response helper
     *
     * @param array $errors
     * @param string $message
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function validation_error_response($errors, $message = 'Validation failed')
    {
        return error_response($message, $errors, 422);
    }
}

if (!function_exists('unauthorized_response')) {
    /**
     * Unauthorized response helper
     *
     * @param string $message
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function unauthorized_response($message = 'Unauthorized access')
    {
        return error_response($message, null, 401);
    }
}

if (!function_exists('forbidden_response')) {
    /**
     * Forbidden response helper
     *
     * @param string $message
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    function forbidden_response($message = 'Access forbidden')
    {
        return error_response($message, null, 403);
    }
}
