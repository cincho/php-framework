<?php

declare(strict_types=1);

namespace Framework\Template;

use Exception;

class Renderer
{
	private array $data = [];

	public function __construct(private array $paths)
	{}

	public function render(string $template, array $data = []): string
	{
		foreach ($this->paths as $path) {
			$file = sprintf('%s/%s', $path, $template);

			if (file_exists($file)) {
				return (function($file, $data) {
					ob_start();
					$data = array_merge($this->data, $data);
					extract($data);
					include $file;
					$output = ob_get_clean();
					return $output;
				})($file, $data);
			}
		}

		throw new Exception(sprintf('Template %s not found', $template));
	}

	public function addData(string $key, mixed $value): void
	{
		$this->data[$key] = $value;
	}
}