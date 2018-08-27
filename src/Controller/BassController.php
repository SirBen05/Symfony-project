<?php

namespace App\Controller;

use App\Entity\Bass;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BassController extends Controller
{
  /**
   * @Route("/bass", name="bass_list")
   * @Method({"GET"})
   */
  public function index(){
    $bass = $this ->getDoctrine()
      ->getRepository(Bass::class)
      ->findAll();
    return $this->render('bass/index.html.twig', [
      'bass' => $bass
    ]);
  }

  /**
   * @Route("/bass/new", name="bass_new")
   * @Method({"GET", "POST"})
   */
  public function new(Request $request){
    $bass = new Bass();

    $form = $this->createFormBuilder($bass)
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
      $bass = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($bass);
      $entityManager->flush();

      return $this->redirectToRoute('bass_list');
    }
    return $this->render('bass/new.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/bass/update/{id}", name="bass_update")
   * @Method({"GET", "POST"})
   */
  public function update(Request $request, $id){
    $bass = $this->getDoctrine()->getRepository(Bass::class)->find($id);
    $form = $this->createFormBuilder($bass)
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
      return $this->redirectToRoute('bass_list');
    }
    return $this->render('bass/update.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/bass/delete/{id}", name="bass_delete")
   * @Method({"DELETE"})
   */
  public function delete($id){
    $bass = $this->getDoctrine()->getRepository(Bass::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($bass);
    $entityManager->flush();

    $response = new Response();
    $response->send();
  }

  /**
   * @Route("/bass/{id}", name="bass_show")
   * @Method({"GET"})
   */
  public function show($id)
  {
    $bass = $this->getDoctrine()->getRepository(Bass::class)->find($id);
    return $this->render('bass/show.html.twig', ['bass' => $bass]);
  }
}