<?php

declare(strict_types=1);

namespace Framework\Security;

use Framework\Session\Session;

class Security
{
	public function __construct(private Session $session)
	{

	}

	public function getAccount(): mixed
	{
		return $this->session->get('account_id');
	}
}