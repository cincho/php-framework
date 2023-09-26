<?php

declare(strict_types=1);

namespace Framework\Session;

class Session
{

	public function start(): void
	{
		session_start();
	}

	public function set(string $key, mixed $value): void
	{
		$_SESSION[$key] = $value;
	}

	public function get(string $key, mixed $value = null): mixed
	{
		return $_SESSION[$key] ?? $value;
	}
}