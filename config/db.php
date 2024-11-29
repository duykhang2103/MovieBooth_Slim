<?php

use App\Infrastructure\Utility\SettingsInterface;
use DI\ContainerBuilder;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return function (ContainerBuilder $containerBuilder) {
  $containerBuilder->addDefinitions([
    EntityManager::class => function (ContainerInterface $c): EntityManager {
      $settings = $c->get(SettingsInterface::class);
      $cache = $settings->get('doctrine')['dev_mode'] ?
        new ArrayAdapter() :
        new FilesystemAdapter('', 0, $settings->get('doctrine')['cache_dir']);

      $config = ORMSetup::createAttributeMetadataConfiguration(
        $settings->get('doctrine')['metadata_dirs'],
        $settings->get('doctrine')['dev_mode'],
        null,
        $cache
      );
      $connection = DriverManager::getConnection($settings->get('doctrine')['connection']);
      return new EntityManager($connection, $config);
    }
  ]);
};
