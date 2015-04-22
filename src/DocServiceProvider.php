<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 4/19/15
 * Time: 5:46 PM
 */

namespace B2k\Doc;


use B2k\Doc\Command\CreateDatabaseDoctrineCommand;
use B2k\Doc\Command\DropDatabaseDoctrineCommand;
use B2k\Doc\Command\Proxy;
use Saxulum\Console\Silex\Provider\ConsoleProvider;
use Saxulum\DoctrineOrmManagerRegistry\Silex\Provider\DoctrineOrmManagerRegistryProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Doctrine\ORM\Tools\Console\Command;

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
        if (php_sapi_name() === 'cli') {
            $app['console.commands'] = $app->extend('console.commands', function ($commands) use ($app) {
                return array_merge(
                    $commands,
                    [
                        new Proxy\DiffCommandProxy(),
                        new Proxy\ExecuteCommandProxy(),
                        new Proxy\GenerateCommandProxy(),
                        new Proxy\LatestCommandProxy(),
                        new Proxy\MigrateCommandProxy(),
                        new Proxy\StatusCommandProxy(),
                        new Proxy\VersionCommandProxy(),

                        new Proxy\ClearMetadataCacheDoctrineCommand(),
                        new Proxy\ClearQueryCacheDoctrineCommand(),
                        new Proxy\ClearResultCacheDoctrineCommand(),
                        new Proxy\ConvertMappingDoctrineCommand(),
                        new Proxy\CreateSchemaDoctrineCommand(),
                        new Proxy\DropSchemaDoctrineCommand(),
                        new Proxy\EnsureProductionSettingsDoctrineCommand(),
                        new Proxy\InfoDoctrineCommand(),
                        new Proxy\RunDqlDoctrineCommand(),
                        new Proxy\RunSqlDoctrineCommand(),
                        new Proxy\UpdateSchemaDoctrineCommand(),
                        new Proxy\UpdateSchemaDoctrineCommand(),
                        new Proxy\ValidateSchemaCommand(),

                        new CreateDatabaseDoctrineCommand(),
                        new DropDatabaseDoctrineCommand(),
                    ]
                );
            });
        }
    }
}