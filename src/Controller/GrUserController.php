<?php

namespace App\Controller;

use App\Entity\GrUser;
use App\Form\GrUserType;
use App\Repository\GrUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gr/user")
 */
class GrUserController extends AbstractController
{
    /**
     * @Route("/", name="app_gr_user_index", methods={"GET"})
     */
    public function index(GrUserRepository $grUserRepository): Response
    {
        return $this->render('gr_user/index.html.twig', [
            'gr_users' => $grUserRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_gr_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GrUserRepository $grUserRepository): Response
    {
        $grUser = new GrUser();
        $form = $this->createForm(GrUserType::class, $grUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $grUserRepository->add($grUser);
            return $this->redirectToRoute('app_gr_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gr_user/new.html.twig', [
            'gr_user' => $grUser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_gr_user_show", methods={"GET"})
     */
    public function show(GrUser $grUser): Response
    {
        return $this->render('gr_user/show.html.twig', [
            'gr_user' => $grUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_gr_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, GrUser $grUser, GrUserRepository $grUserRepository): Response
    {
        $form = $this->createForm(GrUserType::class, $grUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $grUserRepository->add($grUser);
            return $this->redirectToRoute('app_gr_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gr_user/edit.html.twig', [
            'gr_user' => $grUser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_gr_user_delete", methods={"POST"})
     */
    public function delete(Request $request, GrUser $grUser, GrUserRepository $grUserRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grUser->getId(), $request->request->get('_token'))) {
            $grUserRepository->remove($grUser);
        }

        return $this->redirectToRoute('app_gr_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
