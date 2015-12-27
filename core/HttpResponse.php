<?php

namespace Core;


class HttpResponse
{

    const HTTP_PREFIX = 'HTTP/1.1';
    const HTTP_CONTINUE = 100;
    const HTTP_CONTINUE_MESSAGE = ' 100 Continue ';
    const HTTP_OK = 200;
    const HTTP_OK_MESSAGE = ' 200 OK ';
    const HTTP_CREATED = 201;
    const HTTP_CREATED_MESSAGE = ' 201 Created ';
    const HTTP_ACCEPTED = 202;
    const HTTP_ACCEPTED_MESSAGE = ' 202 Accepted ';
    const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_NON_AUTHORITATIVE_INFORMATION_MESSAGE = ' 203 Non-Authoritative Information ';
    const HTTP_NO_CONTENT = 204;
    const HTTP_NO_CONTENT_MESSAGE = ' 204 No Content ';
    const HTTP_RESET_CONTENT = 205;
    const HTTP_RESET_CONTENT_MESSAGE = ' 205 Reset Content ';
    const HTTP_PARTIAL_CONTENT = 206;
    const HTTP_PARTIAL_CONTENT_MESSAGE = ' 206 Partial Content ';
    const HTTP_MULTIPLE_CHOICES = 300;
    const HTTP_MULTIPLE_CHOICES_MESSAGE = ' 300 Multiple Choices ';
    const HTTP_MOVED_PERMANENTLY = 301;
    const HTTP_MOVED_PERMANENTLY_MESSAGE = ' 301 Moved Permanently ';
    const HTTP_FOUND = 302;
    const HTTP_FOUND_MESSAGE = ' 302 Found ';
    const HTTP_SEE_OTHER = 303;
    const HTTP_SEE_OTHER_MESSAGE = ' 303 See Other ';
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_NOT_MODIFIED_MESSAGE = ' 304 Not Modified ';
    const HTTP_USE_PROXY = 305;
    const HTTP_USE_PROXY_MESSAGE = ' 305 Use Proxy ';
    const HTTP_TEMPORARY_REDIRECT = 307;
    const HTTP_TEMPORARY_REDIRECT_MESSAGE = ' 307 Temporary Redirect ';
    const HTTP_BAD_REQUEST = 400;
    const HTTP_BAD_REQUEST_MESSAGE = ' 400 Bad Request ';
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_UNAUTHORIZED_MESSAGE = ' 401 Unauthorized ';
    const HTTP_PAYMENT_REQUIRED = 402;
    const HTTP_PAYMENT_REQUIRED_MESSAGE = ' 402 Payment Required ';
    const HTTP_FORBIDDEN = 403;
    const HTTP_FORBIDDEN_MESSAGE = ' 403 Forbidden ';
    const HTTP_NOT_FOUND = 404;
    const HTTP_NOT_FOUND_MESSAGE = ' 404 Not Found ';
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_METHOD_NOT_ALLOWED_MESSAGE = ' 405 Method Not Allowed ';
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_NOT_ACCEPTABLE_MESSAGE = ' 406 Not Acceptable ';
    const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_PROXY_AUTHENTICATION_REQUIRED_MESSAGE = ' 407 Proxy Authentication Required ';
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_REQUEST_TIMEOUT_MESSAGE = ' 408 Request Timeout ';
    const HTTP_CONFLICT = 409;
    const HTTP_CONFLICT_MESSAGE = ' 409 Conflict ';
    const HTTP_GONE = 410;
    const HTTP_GONE_MESSAGE = ' 410 Gone ';
    const HTTP_LENGTH_REQUIRED = 411;
    const HTTP_LENGTH_REQUIRED_MESSAGE = ' 411 Length Required ';
    const HTTP_PRECONDITION_FAILED = 412;
    const HTTP_PRECONDITION_FAILED_MESSAGE = ' 412 Precondition Failed ';
    const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_REQUEST_ENTITY_TOO_LARGE_MESSAGE = ' 413 Request Entity Too Large ';
    const HTTP_REQUEST_URI_TOO_LONG = 414;
    const HTTP_REQUEST_URI_TOO_LONG_MESSAGE = ' 414 Request-URI Too Long ';
    const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_UNSUPPORTED_MEDIA_TYPE_MESSAGE = ' 415 Unsupported Media Type ';
    const HTTP_NOT_IMPLEMENTED = 501;
    const HTTP_NOT_IMPLEMENTED_MESSAGE = '501 Not Implemented';

    /**
     * @param int $errorCode
     * @param string $message
     */
    public function sendError($errorCode = self::HTTP_NOT_FOUND, $message = self::HTTP_NOT_FOUND_MESSAGE)
    {
        $this->setHeader($errorCode, self::HTTP_PREFIX . $message);
        echo App::gi()->twig->loadTemplate('error.html.twig')->render(['errorCode' => $errorCode, 'message' => $message]);
        die();
    }

    /**
     * @param int $code
     * @param string $message
     */
    public function setStatusCode($code = self::HTTP_OK, $message = self::HTTP_OK_MESSAGE)
    {
        $this->setHeader($code, self::HTTP_PREFIX . $message);
    }

    /**
     * @param string $url
     * @param $statusCode
     */
    public function sendRedirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
    }

    /**
     * @param int $code
     * @param string $message
     */
    private function setHeader($code, $message)
    {
        header($message, true, $code);
    }
}
