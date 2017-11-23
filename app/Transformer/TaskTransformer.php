<?php

	namespace App\Transformer;

	class TaskTransformer {
		public function transform($task) {
		return [
			'id' => $task->id,
			'task' => $task->name,
			'description' => $task->description
		];
	}
}