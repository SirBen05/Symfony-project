<?php

namespace App\Controller;

use App\Entity\Car;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CarController extends Controller
{
  /**
   * @Route("/cars", name="car_list")
   * @Method({"GET"})
   */
  public function index(){
    $cars = $this ->getDoctrine()
      ->getRepository(Car::class)
      ->findAll();
    return $this->render('car/index.html.twig', [
      'cars' => $cars
    ]);
  }

  /**
   * @Route("/car/new", name="car_new")
   * @Method({"GET", "POST"})
   */
  public function new(Request $request){
    $car = new Car();

    $form = $this->createFormBuilder($car)
      ->add('brand', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('model', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('year', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('save', SubmitType::class, [
        'label' => 'Create',
        'attr' => [
          'class' => 'btn btn-primary mt-3']
      ])
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $car = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($car);
      $entityManager->flush();

      return $this->redirectToRoute('car_list');
    }
    return $this->render('car/new.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/car/update/{id}", name="car_update")
   * @Method({"GET", "POST"})
   */
  public function update(Request $request, $id){
    $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
    $form = $this->createFormBuilder($car)
      ->add('brand', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('model', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('year', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('save', SubmitType::class, [
        'label' => 'Create',
        'attr' => [
          'class' => 'btn btn-primary mt-3']
      ])
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();
      return $this->redirectToRoute('car_list');
    }
    return $this->render('car/update.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/car/delete/{id}", name="car_delete")
   * @Method({"DELETE"})
   */
  public function delete($id){
    $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($car);
    $entityManager->flush();

    $response = new Response();
    $response->send();
  }

  /**
   * @Route("/car/{id}", name="car_show")
   * @Method({"GET"})
   */
  public function show($id)
  {
    $car = $this->getDoctrine()->getRepository(Car::class)->find($id);
    return $this->render('car/show.html.twig', ['car' => $car]);
  }
}