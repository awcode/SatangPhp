<?php
namespace Awcode\SatangPhp;

use GuzzleHttp\Client;

class Base
{
    protected $satang_key;
    protected $satang_secret;
    protected $host = 'https://satangcorp.com/api/';
    
    public function __construct($args=[]){
        if($args && is_array($args)){
            if(isset($args['satang_key'])){
                $this->setKey($args['satang_key']);
            }elseif(is_defined('SATANG_KEY')){
                $this->setKey(SATANG_KEY);
            }
            
            if(isset($args['satang_secret'])){
                $this->setSecret($args['satang_secret']);
            }elseif(is_defined('SATANG_SECRET')){
                $this->setSecret(SATANG_SECRET);
            }
        }
    }
    
    public function setKey($key){
        $this->satang_key = $key;
    }
    
    public function setSecret($secret){
        $this->satang_secret = $secret;
    }
    
    public function setHost($host){
        $this->host = $host;
    }
    
    protected function signature($args){
        $str = '';
        foreach($args as $k=>$v){
            if(strlen($str)){$str.='&';}
            $str.= $k.'='.$v;
        }
        return hash_hmac('sha512', $str, $this->satang_secret));
    }
    
    protected function call($path, $args, $mode='POST'){
        $args = ksort($args);
        $signature = $this->signature($args);
        $url = $this->host.$path;

        $client = new Client([
            'headers' => [
                'Authorization'=> 'TDAX-API '.$this->satang_key,
                'Signature' => $signature,
                'Content-Type' => 'application/json'
            ]
        ]);
        
        
        if($mode == 'POST'){
            $response = $client->post($url, [
                \GuzzleHttp\RequestOptions::JSON => $args
            ]);
        }else{
            $str = '';
            foreach($args as $k=>$v){
                if(strlen($str)){$str.='&';}else{$str.='?';}
                $str.= $k.'='.$v;
            }
            $response = $client->get($url.$str, [
                \GuzzleHttp\RequestOptions::JSON => $args
            ]);
        }
        
        return $response;
    }
}
