# Framework guide

This is a guide on how to use the framework to create PHP applications. It's written as a guide rather than a in depth documentation about each individual component.

## Minimum requirements

- PHP 8.2.

## Quick start

In order to use the framework there is no need to use any package manager. You can simply download the source code and use it in your project. This can be done using git from your project directory:

`git clone https://github.com/cincho/php-framework.git src/Framework`

If you want to use the built in autoloader, you will need to add the following to your PHP file.

```
<?php

declare(strict_types=1);

use Framework\Autoloader\Autoloader;

require_once dirname(__DIR__) . '/src/Framework/src/Autoloader/Autoloader.php';

Autoloader::register([
	// Register the Framework namespace.
	'Framework\\' => dirname(__DIR__) . '/src/Framework/src',
	// An any additional namespaces in your application.
	'App\\' => dirname(__DIR__) . '/src/App',
]);
```