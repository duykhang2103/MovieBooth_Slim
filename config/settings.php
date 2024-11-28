<?php

declare(strict_types=1);

use App\Infrastructure\Utility\Settings;
use App\Infrastructure\Utility\SettingsInterface;

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                // 'db' => [
                //     'driver' => 'mysql',
                //     'host' => 'localhost',
                //     'database' => 'test1',
                //     'username' => 'root',
                //     'password' => 'root',
                //     'charset'   => 'utf8',
                //     'collation' => 'utf8_unicode_ci',
                //     'prefix'    => '',
                // ],
                'doctrine' => [
                    'dev_mode' => true,
                    'cache_dir' => __DIR__ . '/../var/doctrine',
                    'metadata_dirs' => [__DIR__ . '/../src/Domain'],
                    'connection' =>  [
                        'driver' => 'pdo_mysql',
                        'host' => 'localhost',
                        'dbname' => 'test',
                        'user' => 'root',
                        'password' => 'root',
                    ]
                ]
            ]);
        }
    ]);
};
