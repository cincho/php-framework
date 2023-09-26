<?php

declare(strict_types=1);

namespace Framework\DependencyInjection;

use Closure;
use Framework\Template\Renderer;
use ReflectionClass;

class Container
{
	private array $items = [];

	public function set(string $id, mixed $value): void
	{
		$this->items[$id] = $value;
	}

	public function get(string $id): mixed
	{
		if (isset($this->items[$id])) {
			$value = $this->items[$id];

			if ($value instanceof Closure) {
				$value = $value($this);
			}

			return $value;
		}

		$reflection = new ReflectionClass($id);
		$constructor = $reflection->getConstructor();
		$args = [];

		if ($constructor) {
			foreach ($constructor->getParameters() as $parameter) {
				$args[] = $this->get($parameter->getType()->getName());
			}
		}

		return $reflection->newInstanceArgs($args);
	}
}