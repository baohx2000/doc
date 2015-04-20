<?php
namespace B2k\Doc\Command\Proxy;

use Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand;
use Saxulum\DoctrineOrmCommands\Command\Proxy\DoctrineCommandHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class StatusCommandProxy extends StatusCommand
{
    protected function configure()
    {
        parent::configure();

        $this->addOption(
            'em',
            null,
            InputOption::VALUE_OPTIONAL,
            'The entity manager to use for this command'
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        DoctrineCommandHelper::setApplicationEntityManager(
            $this->getApplication(),
            $input->getOption('em')
        );

        parent::execute($input, $output);
    }
}
