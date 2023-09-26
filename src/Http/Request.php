<?php

declare(strict_types=1);

namespace Framework\Http;

class Request
{
	public function __construct(
		private array $values
	) {
	}

	public static function fromGlobals(): self
	{
		$values = array_merge($_SERVER, $_REQUEST);

		return new self($values);
	}

	public function get(string $key, mixed $default = null): mixed
	{
		return $this->values[$key] ?? $default;
	}

	public function isPost(): bool
	{
		return $this->values['REQUEST_METHOD'] === 'POST';
	}
}