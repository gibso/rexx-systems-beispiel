<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array(__DIR__."/src");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'rexx',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);

$entityManager = EntityManager::create($dbParams, $config);
$conn = $entityManager->getConnection();
$conn->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');