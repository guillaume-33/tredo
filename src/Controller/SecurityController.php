<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * @Route("/inscription" , name="inscription")
     */
    public function iscription(Request $request , EntityManagerInterface $entityManager , UserPasswordHasherInterface $userPasswordHasher){
       $user = new User();
       $user->setRoles(['ROLE_USER']);

       $form = $this->createForm(UserType::class, $user);
       $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $userPassword=$form->get('password')->getData();
                $cryptPassword=$userPasswordHasher->hashPassword($user, $userPassword);

                $user->setPassword($cryptPassword);

                $entityManager->persist($user);
                $entityManager->flush();
            }
            return $this->render('inscription.html.twig',[
                'form'=> $form->createView()
                ]);
    }
}
