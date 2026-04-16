<?php

namespace App;

class RateLimiter
{
    private $limit;
    private $interval;
    private $requests = [];

    public function __construct($limit, $interval)
    {
        $this->limit = $limit;
        $this->interval = $interval;
    }

    public function allow()
    {
        $now = time();
        $validRequests = [];

        foreach ($this->requests as $timestamp) {
            if ($now - $timestamp < $this->interval) {
                $validRequests[] = $timestamp;
            }
        }

        if (count($validRequests) < $this->limit) {
            $validRequests[] = $now;
            $this->requests = $validRequests;
            return true;
        }

        return false;
    }
}
