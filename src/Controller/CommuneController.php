<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Form\CommuneType;
use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/commune")
 */
class CommuneController extends AbstractController
{
    /**
     * @Route("/", name="commune_index", methods={"GET"})
     */
    public function index(Request $request, CommuneRepository $communeRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $communeRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );
        return $this->render('commune/index.html.twig', [
            'communes' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="commune_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commune = new Commune();
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commune);
            $entityManager->flush();

            return $this->redirectToRoute('commune_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commune/new.html.twig', [
            'commune' => $commune,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="commune_show", methods={"GET"})
     */
    public function show(Commune $commune): Response
    {
        return $this->render('commune/show.html.twig', [
            'commune' => $commune,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commune_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commune $commune): Response
    {
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commune_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commune/edit.html.twig', [
            'commune' => $commune,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="commune_delete", methods={"POST"})
     */
    public function delete(Request $request, Commune $commune): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commune->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commune);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commune_index', [], Response::HTTP_SEE_OTHER);
    }
}
