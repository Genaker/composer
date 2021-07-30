<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Genaker\AppComposer\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\ShellInterface;

class Composer extends Command
{

    const NAME_ARGUMENT = "path";

    public $exec;

    public function _constructor(ShellInterface $exec)
    {
        $this->exec = $exec;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $path = $input->getArgument(self::NAME_ARGUMENT);
        //$pathCode = 'https://github.com/' . $package . '/archive/refs/tags/' . $version . '.zip';
        $this->exec->exec('curl ' . $path.  ' -L -o '. BP . '/var/tmp.zip');
       
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("genaker:composer");
        $this->setDescription("Add Composer Packagist or Git Package to the app folder");
        $this->setDefinition([
            new InputArgument(self::NAME_ARGUMENT, InputArgument::OPTIONAL, "path"),
        ]);
        parent::configure();
    }
}

