<?php
namespace Awcode\SatangPhp;

use Awcode\SatangPhp\Base;

class SatangPhp extends Base
{
    
    public function __construct($args=[]){
        parent::construct($args);
    }
    
    
    public function createOrder($amount, $price, $pair='usd_thb', $side='buy', $type='limit'){
    
        $args = [
            "amount" => $amount,
            "nounce" => $amount,
            "pair" => $amount,
            "price" => $amount,
            "side" => $amount,
            "type" => $amount
        ];
        
        return $this->call('orders', $args);
    }
    
}
