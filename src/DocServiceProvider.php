<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 4/19/15
 * Time: 5:46 PM
 */

namespace B2k\Doc;


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
        $app->register(new DoctrineOrmManagerRegistryProvider);
        // if console register console providers
        if (php_sapi_name() === 'cli') {
            $app->register(new ConsoleProvider);
        }
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
        // if running under cli, inject console commands
    }
}