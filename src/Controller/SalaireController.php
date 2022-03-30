<?php

namespace App\Controller;

use App\Entity\Salaire;
use App\Form\SalaireType;
use App\Repository\SalaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salaire")
 */
class SalaireController extends AbstractController
{
    /**
     * @Route("/", name="app_salaire_index", methods={"GET"})
     */
    public function index(SalaireRepository $salaireRepository): Response
    {
        return $this->render('salaire/index.html.twig', [
            'salaires' => $salaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_salaire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SalaireRepository $salaireRepository): Response
    {
        $salaire = new Salaire();
        $form = $this->createForm(SalaireType::class, $salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salaireRepository->add($salaire);
            return $this->redirectToRoute('app_salaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salaire/new.html.twig', [
            'salaire' => $salaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_salaire_show", methods={"GET"})
     */
    public function show(Salaire $salaire): Response
    {
        return $this->render('salaire/show.html.twig', [
            'salaire' => $salaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_salaire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Salaire $salaire, SalaireRepository $salaireRepository): Response
    {
        $form = $this->createForm(SalaireType::class, $salaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $salaireRepository->add($salaire);
            return $this->redirectToRoute('app_salaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('salaire/edit.html.twig', [
            'salaire' => $salaire,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_salaire_delete", methods={"POST"})
     */
    public function delete(Request $request, Salaire $salaire, SalaireRepository $salaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salaire->getId(), $request->request->get('_token'))) {
            $salaireRepository->remove($salaire);
        }

        return $this->redirectToRoute('app_salaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
