<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 4/19/15
 * Time: 5:46 PM
 */

namespace B2k\Doc;


use B2k\Doc\Command\Proxy\DiffCommandProxy;
use B2k\Doc\Command\Proxy\ExecuteCommandProxy;
use B2k\Doc\Command\Proxy\GenerateCommandProxy;
use B2k\Doc\Command\Proxy\LatestCommandProxy;
use B2k\Doc\Command\Proxy\MigrateCommandProxy;
use B2k\Doc\Command\Proxy\StatusCommandProxy;
use B2k\Doc\Command\Proxy\VersionCommandProxy;
use Saxulum\Console\Silex\Provider\ConsoleProvider;
use Saxulum\DoctrineOrmManagerRegistry\Silex\Provider\DoctrineOrmManagerRegistryProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;

class DocServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     * @param Application $app
     */
    public function register(Application $app)
    {
        // if console register console providers
        if (php_sapi_name() === 'cli') {
            $app->register(new ConsoleProvider);
        }
        $app->register(new DoctrineOrmManagerRegistryProvider);
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app['console.commands'] = $app->extend('console.commands', function ($commands) use ($app) {
            return array_merge(
                $commands,
                [
                    new DiffCommandProxy(),
                    new ExecuteCommandProxy(),
                    new GenerateCommandProxy(),
                    new LatestCommandProxy(),
                    new MigrateCommandProxy(),
                    new StatusCommandProxy(),
                    new VersionCommandProxy(),
                ]
            );
        });
    }
}