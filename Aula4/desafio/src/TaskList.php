<?php
declare(strict_types = 1);

namespace src;

class TaskList
{
    /** @var Task[] */
    public array $tasks = [];

    public function add(string $title, int $priority, string $deadline, bool $done): void
    {
        if (strlen($title) <= 0) {
            throw new \InvalidArgumentException('Title cannot be empty');
        }

        if ($priority < 1 || $priority > 5) {
            throw new \InvalidArgumentException('Priority must be between 1 and 5');
        }


        $this->tasks[] = new Task($title, $priority, $deadline, $done);
    }

    public function complete(int $iteratorKey): bool
    {
        if (!isset($this->tasks[$iteratorKey]) || $this->tasks[$iteratorKey]->isUnfinished()) {
            return false;
        }

        $this->tasks[$iteratorKey]->complete();

        return true;
    }

    public function getTasksUnfinishedByPriority(int $priority): array
    {
        $tasks = [];

        foreach ($this->tasks as $task) {
            if ($task->priority === $priority && $task->isUnfinished()) {
                $tasks[] = $task;
            }
        }

        return $tasks;
    }
}