<?php

namespace App\Controller;

use App\Entity\District;
use App\Form\DistrictType;
use App\Repository\DistrictRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/district")
 */
class DistrictController extends AbstractController
{
    /**
     * @Route("/", name="district_index", methods={"GET"})
     */
    public function index(Request $request, DistrictRepository $districtRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $districtRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );
        return $this->render('district/index.html.twig', [
            'districts' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="district_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $district = new District();
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($district);
            $entityManager->flush();

            return $this->redirectToRoute('district_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('district/new.html.twig', [
            'district' => $district,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="district_show", methods={"GET"})
     */
    public function show(District $district): Response
    {
        return $this->render('district/show.html.twig', [
            'district' => $district,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="district_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, District $district): Response
    {
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('district_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('district/edit.html.twig', [
            'district' => $district,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="district_delete", methods={"POST"})
     */
    public function delete(Request $request, District $district): Response
    {
        if ($this->isCsrfTokenValid('delete'.$district->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($district);
            $entityManager->flush();
        }

        return $this->redirectToRoute('district_index', [], Response::HTTP_SEE_OTHER);
    }
}
