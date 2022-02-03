<?php
namespace Awcode\SatangPhp;

use Awcode\SatangPhp\Base;

class SatangPhp extends Base
{
    
    public function __construct($args=[]){
        parent::__construct($args);
    }
    
    
    public function createOrder($amount, $price, $pair='usd_thb', $side='buy', $type='limit'){
    
        $args = [
            "amount" => (string)$amount,
            "nounce" => md5(time()),
            "pair" => $pair,
            "price" => (string)$price,
            "side" => $side,
            "type" => $type
        ];
        
        return $this->call('orders', $args);
    }
    
}
