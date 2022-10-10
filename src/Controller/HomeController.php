<?php

namespace App\Controller;

use App\Entity\Equipage;
use App\Form\EquipageType;
use App\Repository\EquipageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EquipageRepository $equipageRepository, HttpFoundationRequest $request, MailerInterface $mailer, ManagerRegistry $doctrine): Response
    {
        $equipage = new Equipage();

        $form = $this->createForm(EquipageType::class, $equipage);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $email = (new TemplatedEmail())
                    ->from($equipage->getEmail())
                    ->to('mbayemamadoutalla@gmail.com')
                    ->context([
                        'nom' => $equipage->getFistName(),
                        'prénom' => $equipage->getLastName(),
                        'E-mail' => $equipage->getEmail(),
                        'adress' => $equipage->getAdress(),
                        'city' => $equipage->getCity()
                    ]);

                $em = $doctrine->getManager();
                $em->persist($equipage);
                $em->flush();

                $mailer->send($email);
                $this->addFlash('notice', 'Message envoyé');

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('home/index.html.twig', [
            'equipage' => $equipageRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}