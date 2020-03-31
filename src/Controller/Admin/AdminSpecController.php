<?php

namespace App\Controller\Admin;

use App\Entity\Spec;
use App\Form\SpecType;
use App\Repository\SpecRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/spec")
 */
class AdminSpecController extends AbstractController
{
    /**
     * @Route("/", name="admin.spec_index", methods={"GET"})
     * @param SpecRepository $specRepository
     * @return Response
     */
    public function index(SpecRepository $specRepository): Response
    {
        return $this->render('admin/spec/index.html.twig', [
            'specs' => $specRepository->findAll(),
            'admin' => true
        ]);
    }

    /**
     * @Route("/new", name="admin.spec_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $spec = new Spec();
        $form = $this->createForm(SpecType::class, $spec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($spec);
            $entityManager->flush();

            return $this->redirectToRoute('admin.spec_index');
        }

        return $this->render('admin/spec/new.html.twig', [
            'spec' => $spec,
            'form' => $form->createView(),
            'admin' => true
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.spec_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Spec $spec
     * @return Response
     */
    public function edit(Request $request, Spec $spec): Response
    {

        $form = $this->createForm(SpecType::class, $spec);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin.spec_index');
        }

        return $this->render('admin/spec/edit.html.twig', [
            'spec' => $spec,
            'form' => $form->createView(),
            'admin' => true
        ]);
    }

    /**
     * @Route("/{id}", name="admin.spec_delete", methods={"DELETE"})
     * @param Request $request
     * @param Spec $spec
     * @return Response
     */
    public function delete(Request $request, Spec $spec): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spec->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($spec);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin.spec_index');
    }
}
