<?php

namespace App\Controller;

use App\Entity\Person;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PersonController extends Controller
{
  /**
   * @Route("/people")
   * @Method({"GET"})
   */
  public function index(){
    $people = $this ->getDoctrine()
      ->getRepository(Person::class)
      ->findAll();
    return $this->render('person/index.html.twig', [
      'people' => $people
    ]);
  }

  /**
   * @Route("/person/save")
   * @Method({"GET"})
   */
  public function save(){
    $entityManager = $this->getDoctrine()->getManager();

    $person = new Person();
    $person->setName('Zilvinas');
    $person->setSurname('Vidmantas');
    $person->setAge('25');

    $entityManager->persist($person);
    $entityManager->flush();

    return new Response('Saved data to DB with ID of: '.$person->getId());
  }
}