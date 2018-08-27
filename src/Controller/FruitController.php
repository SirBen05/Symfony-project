<?php

namespace App\Controller;

use App\Entity\Fruit;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FruitController extends Controller
{
  /**
   * @Route("/fruit", name="fruit_list")
   * @Method({"GET"})
   */
  public function index(){
    $fruit = $this ->getDoctrine()
      ->getRepository(Fruit::class)
      ->findAll();
    return $this->render('fruit/index.html.twig', [
      'fruit' => $fruit
    ]);
  }

  /**
   * @Route("/fruit/new", name="fruit_new")
   * @Method({"GET", "POST"})
   */
  public function new(Request $request){
    $fruit = new Fruit();

    $form = $this->createFormBuilder($fruit)
      ->add('color', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('cultivar', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('weight', TextType::class, [
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
      $fruit = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($fruit);
      $entityManager->flush();

      return $this->redirectToRoute('fruit_list');
    }
    return $this->render('fruit/new.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/fruit/update/{id}", name="fruit_update")
   * @Method({"GET", "POST"})
   */
  public function update(Request $request, $id){
    $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
    $form = $this->createFormBuilder($fruit)
      ->add('color', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('cultivar', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('weight', TextType::class, [
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
      return $this->redirectToRoute('fruit_list');
    }
    return $this->render('fruit/update.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/fruit/delete/{id}", name="fruit_delete")
   * @Method({"DELETE"})
   */
  public function delete($id){
    $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($fruit);
    $entityManager->flush();

    $response = new Response();
    $response->send();
  }

  /**
   * @Route("/fruit/{id}", name="fruit_show")
   * @Method({"GET"})
   */
  public function show($id)
  {
    $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
    return $this->render('fruit/show.html.twig', ['fruit' => $fruit]);
  }
}