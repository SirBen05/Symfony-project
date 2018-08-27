<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class HomeController extends Controller
{
  /**
   * @Route("/")
   * @Method({"GET"})
   */
  public function index(){
    return $this->render('home/index.html.twig');
  }
}