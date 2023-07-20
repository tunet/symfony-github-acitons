<?php

namespace Unit;

use App\Entity\Task;
use App\Service\TaskSorter;
use PHPUnit\Framework\TestCase;

class TaskSorterTest extends TestCase
{
	public function testSort(): void
    {
        $sorter = new TaskSorter();
        $sortedTasks = $sorter->sort([
            (new Task())->setTitle('Ddd'),
            (new Task())->setTitle('Aaa'),
        ]);

        $this->assertSame('Aaa', $sortedTasks[0]->getTitle());
        $this->assertSame('Ddd', $sortedTasks[1]->getTitle());
    }
}
