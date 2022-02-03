<?php
namespace Awcode\SatangPhp;

use Awcode\SatangPhp\Base;

class SatangPhp extends Base
{
    
    public function __construct($args=[]){
        parent::__construct($args);
    }
    
    
    public function createOrder($amount, $price, $pair='btc_thb', $side='buy', $type='limit'){
    
        $args = [
            "amount" => (string)$amount,
            "nounce" => md5(time()),
            "pair" => (string)$pair,
            "price" => (string)$price,
            "side" => (string)$side,
            "type" => (string)$type
        ];
        
        return $this->call('orders', $args);
    }
    
    public function getCurrentRate($pair='btc_thb'){
        $args = [
            'symbol' => $pair
        ];
    
        return $this->call('v3/depth', $args, 'GET');
    }
    
}
