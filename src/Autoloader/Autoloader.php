<?php

declare(strict_types=1);

namespace Framework\Autoloader;

class Autoloader
{
	private static array $map = [];

	public static function register(array $map): void
	{
		self::$map = $map;
	}

	public static function autoload(string $class): void
	{
		foreach (self::$map as $pattern => $path) {
			if (str_starts_with($class, $pattern)) {
				require_once sprintf('%s/%s.php', $path, str_replace('\\', '/', str_replace($pattern, '', $class)));
				return;
			}
		}
	}
}

spl_autoload_register([Autoloader::class, 'autoload']);