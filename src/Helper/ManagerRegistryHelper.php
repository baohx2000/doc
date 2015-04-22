<?php
namespace B2k\Doc\Helper;

use Symfony\Component\Console\Helper\Helper;
use Doctrine\Common\Persistence\ManagerRegistry;

class ManagerRegistryHelper extends Helper
{
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param $name
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getManager($name)
    {
        return $this->managerRegistry->getManager($name);
    }

    /**
     * @param $name
     * @return object
     */
    public function getConnection($name)
    {
        return $this->managerRegistry->getConnection($name);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'managerregistry';
    }
}
