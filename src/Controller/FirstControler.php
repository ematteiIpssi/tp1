<?php
namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstControler extends AbstractController{
    #[Route('/', name:"app_index")]
    public function index(MessageRepository $ajout){
        $gens = [['prenom'=>'Joseh','nom'=>'Michel','date'=>'2000/09/23'],
                ['prenom'=>'Even','nom'=>'Bertrand','date'=>'1990/09/12']];
        dd($ajout->findAll());
        return $this->render("test/premier.html.twig",['gens'=>$gens]);
    }
    #[Route('/produit/{info<\d+>?1}', name:"app_dynamic",priority:1)]
    public function dynamic($info){
        return $this->render("test/deuxieme.html.twig",['info'=>$info]);
    }
}