<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurFormType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    #[Route('/auteur', name: 'app_auteur')]
    public function index(AuteurRepository $auteur): Response
    {
        dd($auteur->findAll());
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }
    #[Route('/auteur/add', name: 'add_auteur')]

    public function add(){
        $auteur = new Auteur();
        $form = $this->createForm(AuteurFormType::class,$auteur);
        return $this->render('auteur/index.html.twig',[
            'form'=>$form
        ]);
    }
    
}
