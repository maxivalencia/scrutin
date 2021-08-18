<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Entity\Candidat;
use App\Repository\MessagesRepository;
use App\Repository\CandidatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service")
     */
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    /**
     * @Route("/connexion", name="service_connexion", methods={"GET","POST"})
     */
    public function connexion(): Response
    {
        return new JsonResponse(['connexion' => 'teste connexion']);
    }

    /**
     * @Route("/message", name="service_message", methods={"GET","POST"})
     */
    public function message(MessagesRepository $messagesRepository): Response
    {
        $messages = $messagesRepository->findBy([], ['id' => 'desc'], 20);
        $messageliste = [];
        $i = 0;
        foreach($messages as $message){
            $messageliste[$i] = $message->getMessage();
            $i++;
        }
        $response = new JsonResponse($messageliste);
        $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
        return $response;
    }

    /**
     * @Route("/candidat", name="service_candidat", methods={"GET","POST"})
     */
    public function candidat(CandidatRepository $candidatRepository): Response
    {
        $candidats = $candidatRepository->findAll();
        $candidatliste = [];
        foreach($candidats as $candidat){
            $candidatliste[$candidat->getId()] = $candidat->getNom().' '.$candidat->getPrenom();
        }
        $response = new JsonResponse($candidatliste);
        $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
        return $response;
    }

    /**
     * @Route("/resultat", name="service_resultat", methods={"GET","POST"})
     */
    public function resultat(): Response
    {
        return new JsonResponse(['resultat' => 'teste resultat']);
    }
}
