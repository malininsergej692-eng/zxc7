<?php

class RateLimiter {
    private $limit;
    private $interval;
    private $requests = []; 
    public function __construct($limit, $interval) {
        $this->limit = $limit;
        $this->interval = $interval;
    }
    public function allow() {
        $currentTime = time();
        foreach ($this->requests as $key => $timestamp) {
            if ($timestamp <= ($currentTime - $this->interval)) {
                unset($this->requests[$key]);
            }
        }
        if (count($this->requests) < $this->limit) {
            $this->requests[] = $currentTime;
            return true;
        }
        return false;
    }
}
$limiter = new RateLimiter(3, 5);
var_dump($limiter->allow()); 
var_dump($limiter->allow()); 
var_dump($limiter->allow());
var_dump($limiter->allow()); 
echo "Ждем 6 секунд...\n";
sleep(6); 
var_dump($limiter->allow()); 