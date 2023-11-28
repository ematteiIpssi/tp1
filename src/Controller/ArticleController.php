<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(ArticleRepository $Article): Response
    {
        $form="";
        $test= $Article->findAll();
        return $this->render('article/index.html.twig',['form'=>$form]);
    }
    #[Route('/article/add', name: 'add_article')]

    public function add(Request $request, EntityManagerInterface $manager): Response{
        $Article = new Article();
        $form = $this->createFormBuilder($Article)
            ->add('Titre')
            ->add('submit',SubmitType::class,['label'=>'ajouter'])
            ->getForm();
            
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            $this->addFlash('reussit','l\'ajout a été fait');
            return $this->redirectToRoute('app_article');
        }

        return $this->render('article/index.html.twig',[
            'form'=>$form
        ]);
    }
    #[Route('/article/{id}/edit', name:'edit_article')]
    public function edit(Article $id,Request $request,EntityManagerInterface $manager):Response{
        $form = $this->createFormBuilder($id)
        ->add('Titre')
        ->add('submit',SubmitType::class,['label'=>'modifier'])
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            $this->addFlash('reussit','la modification a été fait');
            return $this->redirectToRoute('app_article');
        }
        return $this->render('article/index.html.twig',[
            'form'=>$form
        ]);
    }
    #[Route('/article/remove', name:'remove_article')]

    public function remove(Article $id, Request $request, EntityManagerInterface $manager):Response{
        $form = $this->createFormBuilder()
        ->add("Id a supprimer")
        ->add('submit',SubmitType::class,['label'=>'suprrimer'])
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $manager->remove($data);
            $manager->flush();
        }
        return $this->render('article/index.html.twig',[
            'form'=>$form
        ]);
    }
}
