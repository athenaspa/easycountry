<?php
namespace Msp;
use Object_Core;
use Exception;

/**
 * Class Core
 * @package Msp
 */
class Core extends Object_Core {

    /**
     * @param $http_method
     * @param $api_method
     * @param null $http_body
     * @return mixed
     * @throws Exception
     */
    protected function processRequest($http_method, $api_method, $http_body = NULL) {
        $body = $this->mspapi->processAPIRequest($http_method, $api_method, $http_body);
        if (!($object = @json_decode($body))) {
            throw new Exception("'{$body}'.");
        }

        if (!empty($object->error_code)) {
            $exception = new Exception("{$object->error_code}: {$object->error_info}.");
            throw $exception;
        }
        return $object;
    }

}
