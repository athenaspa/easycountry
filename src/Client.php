<?php
namespace Msp;
use Client as BaseClient;
use Msp\Orders;
use Exception;


/**
 * Class Client
 * @package Msp
 */
class Client extends BaseClient {

    /**
     * Client constructor.
     */
    public function __construct() {
        $this->orders = new Orders($this);
    }

}

