<?php

namespace App\Controller;

use App\Entity\Population;
use App\Form\PopulationType;
use App\Repository\PopulationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/population")
 */
class PopulationController extends AbstractController
{
    /**
     * @Route("/", name="population_index", methods={"GET"})
     */
    public function index(PopulationRepository $populationRepository): Response
    {
        return $this->render('population/index.html.twig', [
            'populations' => $populationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="population_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $population = new Population();
        $form = $this->createForm(PopulationType::class, $population);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($population);
            $entityManager->flush();

            return $this->redirectToRoute('population_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('population/new.html.twig', [
            'population' => $population,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="population_show", methods={"GET"})
     */
    public function show(Population $population): Response
    {
        return $this->render('population/show.html.twig', [
            'population' => $population,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="population_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Population $population): Response
    {
        $form = $this->createForm(PopulationType::class, $population);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('population_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('population/edit.html.twig', [
            'population' => $population,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="population_delete", methods={"POST"})
     */
    public function delete(Request $request, Population $population): Response
    {
        if ($this->isCsrfTokenValid('delete'.$population->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($population);
            $entityManager->flush();
        }

        return $this->redirectToRoute('population_index', [], Response::HTTP_SEE_OTHER);
    }
}
