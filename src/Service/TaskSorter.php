<?php

namespace App\Service;

use App\Entity\Task;

class TaskSorter
{
    /**
     * @param array<Task> $tasks
     */
	public function sort(array $tasks): array
    {
        usort($tasks, fn (Task $a, Task $b) => $a->getTitle() <=> $b->getTitle());

        return $tasks;
    }
}
