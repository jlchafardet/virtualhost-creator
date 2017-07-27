<?php

namespace jlchafardet\Console;

use Symfony\Component\Console\Application as BaseApplication;

use jlchafardet\Console\Command\BatchProcessCommand;


class Appliction extends BaseApplication
{
	const NAME = 'Virtualhost Creator';
	const VERSION = '1.0';

	public function __construct()
	{
		parent::_construct(static::NAME, static::VERSION);

		$batchProcessCommand = new BatchProcessCommand();
        $this->add($batchProcessCommand);
	}
}