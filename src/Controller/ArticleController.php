<?php 

namespace App\Controller;

use App\Entity\Article;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ArticleController extends Controller{

  /**
   * @Route("/articles", name="article_list")
   * @Method({"GET"})
 */
  public function index(){
    $articles = $this ->getDoctrine()
                      ->getRepository(Article::class)
                      ->findAll();
    return $this->render('article/index.html.twig', [
      'name' => 'Zilvinas',
      'articles' => $articles
    ]);
  }

  /**
   * @Route("/article/new", name="article_new")
   * @Method({"GET", "POST"})
   */
  public function new(Request $request){
    $article = new Article();

    $form = $this->createFormBuilder($article)
      ->add('title', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('body', TextareaType::class, [
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
      $article = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($article);
      $entityManager->flush();

      return $this->redirectToRoute('article_list');
    }
    return $this->render('article/new.html.twig', [
      'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/article/update/{id}", name="article_update")
   * @Method({"GET", "POST"})
   */
  public function update(Request $request, $id){
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

    $form = $this->createFormBuilder($article)
      ->add('title', TextType::class, [
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('body', TextareaType::class, [
        'required' => false,
        'attr' => [
          'class'=> 'form-control'
        ]
      ])
      ->add('save', SubmitType::class, [
        'label' => 'Update',
        'attr' => [
          'class' => 'btn btn-primary mt-3']
      ])
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();

      return $this->redirectToRoute('article_list');
    }
    return $this->render('article/update.html.twig', [
        'form'=> $form->createView()]
    );
  }

  /**
   * @Route("/article/delete/{id}", name="article_delete")
   * @Method({"DELETE"})
   */
  public function delete($id){
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();

    $response = new Response();
    $response->send();
  }

  /**
   * @Route("/article/{id}", name="article_show")
   * @Method({"GET"})
   */
  public function show($id){
    $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
    return $this->render('article/show.html.twig', ['article'=>$article]);
  }
}