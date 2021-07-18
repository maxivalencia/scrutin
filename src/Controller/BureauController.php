<?php

namespace App\Controller;

use App\Entity\Bureau;
use App\Form\BureauType;
use App\Repository\BureauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bureau")
 */
class BureauController extends AbstractController
{
    /**
     * @Route("/", name="bureau_index", methods={"GET"})
     */
    public function index(BureauRepository $bureauRepository): Response
    {
        return $this->render('bureau/index.html.twig', [
            'bureaus' => $bureauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bureau_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bureau = new Bureau();
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bureau);
            $entityManager->flush();

            return $this->redirectToRoute('bureau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bureau/new.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bureau_show", methods={"GET"})
     */
    public function show(Bureau $bureau): Response
    {
        return $this->render('bureau/show.html.twig', [
            'bureau' => $bureau,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bureau_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bureau $bureau): Response
    {
        $form = $this->createForm(BureauType::class, $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bureau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bureau/edit.html.twig', [
            'bureau' => $bureau,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bureau_delete", methods={"POST"})
     */
    public function delete(Request $request, Bureau $bureau): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bureau->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bureau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bureau_index', [], Response::HTTP_SEE_OTHER);
    }
}
