<?php

declare(strict_types=1);

namespace Framework\Http;

class Response
{
	private array $headers = [];
	private int $response_code;
	private ?string $body;

	public function __construct(
		int $response_code = 200,
		string $body = null,
	){
		$this->response_code = $response_code;
		$this->body = $body;
	}

	public function addHeader(string $key, string $value): self
	{
		$this->headers[$key] = $value;

		return $this;
	}

	public function emit(): void
	{
		http_response_code($this->response_code);

		foreach ($this->headers as $key => $value) {
			header(sprintf('%s: %s', $key, $value));
		}

		echo $this->body;
	}
}