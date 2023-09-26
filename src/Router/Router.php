<?php

declare(strict_types=1);

namespace Framework\Router;

class Router
{
	private array $routes = [];

	public function add(array|string $method, string $pattern, string $handler, string $name): void
	{
		$this->routes[$name] = [
			'method' => $method,
			'pattern' => $pattern,
			'handler' => $handler,
		];
	}

	public function match(string $method, string $path): ?array
	{
		$path = strtok($path, '?');
		$replacements = [
			'\/' => '/',
			'/' => '\/',
		];

		foreach ($this->routes as $route) {
			if (!in_array($method, (array) $route['method'])) {
				continue;
			}

			$pattern = str_replace(array_keys($replacements), array_values($replacements), $route['pattern']);

			if (preg_match(sprintf('/^%s$/', $pattern), $path, $matches)) {
				$route['params'] = array_filter($matches, fn ($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY);
				return $route;
			}
		}

		return null;
	}

	public function generateUrl(string $name, array $params): string
	{
		$route = $this->routes[$name];

		$replacements = [];

		foreach ($params as $key => $value) {
			$pattern = sprintf('/%s/', sprintf('\(\?<%s>[^\)]+\)', $key));
			$replacements[$pattern] = $value;
		}

		$url = preg_replace(array_keys($replacements), array_values($replacements), $route['pattern']);

		return $url;
	}
}