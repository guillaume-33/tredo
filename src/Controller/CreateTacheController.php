<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTacheController extends AbstractController
{

    /**
     * @Route("/create_tache" , name="create_tache")
     */
        public function createTache(Request $request , EntityManagerInterface $entityManager){

            $tache = New Tache();

            $form = $this->createForm(TacheType::class, $tache);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                $tache->setExpediteur($this->getUser());
                $entityManager->persist($tache);
                $entityManager->flush();
            }

            return $this->render('create_tache.html.twig', [
                'form'=>$form->createView()
            ]);
        }


}