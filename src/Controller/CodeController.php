<?php

namespace App\Controller;

use App\Entity\Code;
use App\Form\CodeType;
use App\Repository\CodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/code")
 */
class CodeController extends AbstractController
{
    /**
     * @Route("/", name="code_index", methods={"GET"})
     */
    public function index(Request $request, CodeRepository $codeRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $codeRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('code/index.html.twig', [
            'codes' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="code_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $code = new Code();
        $form = $this->createForm(CodeType::class, $code);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($code);
            $entityManager->flush();

            return $this->redirectToRoute('code_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('code/new.html.twig', [
            'code' => $code,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="code_show", methods={"GET"})
     */
    public function show(Code $code): Response
    {
        return $this->render('code/show.html.twig', [
            'code' => $code,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="code_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Code $code): Response
    {
        $form = $this->createForm(CodeType::class, $code);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('code_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('code/edit.html.twig', [
            'code' => $code,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="code_delete", methods={"POST"})
     */
    public function delete(Request $request, Code $code): Response
    {
        if ($this->isCsrfTokenValid('delete'.$code->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($code);
            $entityManager->flush();
        }

        return $this->redirectToRoute('code_index', [], Response::HTTP_SEE_OTHER);
    }
}
