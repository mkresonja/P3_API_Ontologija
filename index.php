<?php

require 'vendor/autoload.php';
require 'bootstrap.php';
use Kresonja\Ontologija;
use Composer\Autoload\ClassLoader;

Flight::route('/', function () {

  $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20202021/mkresonja_20/Ontologija/mkresonja_ontologija.rdf');
  $info = $foaf->dump();
  echo "<h2>Ontologija korištena za projektni zadatak iz kolegija Programiranje 3:</h2> <br/><br/>" . $info;
});

Flight::route('GET /search', function () {

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij = $em->getRepository('Kresonja\Ontologija');
  $zapisi = $repozitorij->findAll();
  echo $doctrineBootstrap->getJson($zapisi);
});


Flight::route(
  'GET /table', function () {

    $foaf = \EasyRdf\Graph::newAndLoad('https://oziz.ffos.hr/nastava20202021/mkresonja_20/ontologija/Ontologija/mkresonja_ontologija.rdf');

    foreach ($foaf->resources() as $resource) {

        $i = 0;

        $autor = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#imaAutora>');
        $izdavac = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#imaIzdavaca>');     
        $naslov = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#naslov>');
        $zanr = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#zanr>');
        $brojStranica = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#brojStranica>');
        $godinaIzdanja = ''.$foaf->get($resource, '<http://oziz.ffos.hr/mkresonja/ontologija#jeIzdana>');



        $ontologija = new Ontologija();
        $ontologija->setPodaci(Flight::request()->data);

        $ontologija->setAutor($autor);
        $ontologija->setIzdavac($izdavac);
        $ontologija->setNaslov($naslov);
        $ontologija->setZanr($zanr);
        $ontologija->setBrojStranica($brojStranica);
        $ontologija->setGodinaIzdanja($godinaIzdanja);


        $doctrineBootstrap = Flight::entityManager();
        $em = $doctrineBootstrap->getEntityManager();
  
        $em->persist($ontologija);
        $em->flush();
        //}
      }

      echo "Uspjeh!";

});

Flight::route('GET /search/@naslov', function($naslov){

  $doctrineBootstrap = Flight::entityManager();
  $em = $doctrineBootstrap->getEntityManager();
  $repozitorij=$em->getRepository('Kresonja\Ontologija');
  $zapisi = $repozitorij->createQueryBuilder('p')
                        ->where('p.naslov LIKE :naslov')
                        ->setParameter('naslov', '%'.$naslov.'%')
                        ->getQuery()
                        ->getResult();
  echo $doctrineBootstrap->getJson($zapisi);

});


$cl = new ClassLoader('Kresonja', __DIR__, '/src');
$cl->register();
require_once 'bootstrap.php';
Flight::register('entityManager', 'DoctrineBootstrap');

Flight::start();