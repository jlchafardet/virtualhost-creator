<?php

namespace jlchafardet\Console;

use Symfony\Component\Console\Application as BaseApplication;

use jlchafardet\Console\Command\BatchProcessCommand;


class App extends BaseApplication
{
	const NAME = 'Virtualhost Creator';
	const VERSION = '1.1';

	public function __construct()
	{
		parent::_construct(static::NAME, static::VERSION);

		$batchProcessCommand = new BatchProcessCommand();
        $this->add($batchProcessCommand);
	}
}