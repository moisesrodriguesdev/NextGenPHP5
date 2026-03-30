<?php

namespace src;

class TaskReport
{

    public function __construct(public TaskList $taskList)
    {
    }

    public function run(): string
    {
        $output = "TAREFAS\n";
        $doneCount = 0;
        $pendingCount = 0;
        $overdueCount = 0;

        foreach ($this->taskList->tasks as $task) {
            if ($task->done) {
                $doneCount++;
            } else {
                $pendingCount++;

                if ($task->isOverdue()) {
                    $overdueCount++;
                    $output .= "[ATRASADA] ";
                }
            }

            $output .= $task->title . ' (P' . $task->priority . ')';
            $output .= $task->done ? ' ✓' : ' ✗';
            $output .= "\n";
        }

        $output .= "---\nFeitas: $doneCount | Pendentes: $pendingCount | Atrasadas: $overdueCount\n";

        return $output;
    }
}