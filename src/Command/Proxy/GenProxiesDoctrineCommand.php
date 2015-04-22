<?php

/*
 * This file is part of the Doctrine Bundle
 *
 * The code was originally distributed inside the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 * (c) Doctrine Project, Benjamin Eberlei <kontakt@beberlei.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace B2k\Doc\Command\Proxy;

use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\Tools\Export\Driver\XmlExporter;
use Doctrine\ORM\Tools\Export\Driver\YamlExporter;

/**
 * Convert Doctrine ORM metadata mapping information between the various supported
 * formats.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class GenProxiesDoctrineCommand extends GenerateProxiesCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->addOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        DoctrineCommandHelper::setApplicationEntityManager($this->getApplication(), $input->getOption('em'));

        return parent::execute($input, $output);
    }

    /**
     * @param string $toType
     * @param string $destPath
     *
     * @return \Doctrine\ORM\Tools\Export\Driver\AbstractExporter
     */
    protected function getExporter($toType, $destPath)
    {
        /** @var $exporter \Doctrine\ORM\Tools\Export\Driver\AbstractExporter */
        $exporter = parent::getExporter($toType, $destPath);
        if ($exporter instanceof XmlExporter) {
            $exporter->setExtension('.orm.xml');
        } elseif ($exporter instanceof YamlExporter) {
            $exporter->setExtension('.orm.yml');
        }

        return $exporter;
    }
}
