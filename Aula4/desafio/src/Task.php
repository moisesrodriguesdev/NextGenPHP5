<?php

namespace src;

class Task
{
    public function __construct(
        public string $title,
        public int $priority,
        public ?string $deadline = null,
        public bool $done = false
    )
    {
    }

    public function isOverdue(): bool
    {
        return $this->deadline !== null && $this->deadline < date('Y-m-d');
    }

    public function complete(): void
    {
        $this->done = true;
    }

    public function isUnfinished(): bool
    {
        return !$this->done;
    }


}