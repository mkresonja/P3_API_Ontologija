<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Composer\Autoload\ClassLoader;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DoctrineBootstrap
{
    private $entityManager;
    private $serializer;
    public function __construct()
    {
        $config = Setup::createAnnotationMetadataConfiguration([],true);
        $conn=[
            'dbname'=>'mkresonja_20_20',
            'user'=>'mkresonja_20_20',
            'password'=>'aYcW9AgZ',
            'host'=>'localhost',
            'driver'=>'pdo_mysql',
            'charset'=>'utf8mb4',
            'driverOptions'=>[1002 => 'set names utf8mb4']
        ];
        $this->entityManager = EntityManager::create($conn,$config);

    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function getJson($podaci)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->serialize($podaci,'json');
    }
}

?>