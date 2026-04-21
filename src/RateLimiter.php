<?php

namespace App;

class RateLimiter
{
    private int $limit;
    private int $interval;
    private array $requests = [];

    public function __construct(int $limit, int $interval)
    {
        $this->limit = $limit;
        $this->interval = $interval;
    }

    public function allow(): bool
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
