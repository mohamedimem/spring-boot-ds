<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\Soutenance;
use App\Form\EtudiantType;
use App\Form\SoutenanceType;
use App\Repository\SoutenanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Psr\Log\LoggerInterface;



#[Route('/soutenance')]
final class SoutenanceController extends AbstractController
{
    #[Route(name: 'app_soutenance_index', methods: ['GET'])]
    public function index(SoutenanceRepository $soutenanceRepository): Response
    {
        return $this->render('soutenance/index.html.twig', [
            'soutenances' => $soutenanceRepository->findAll(),
        ]);
    }
    public function __construct(private LoggerInterface $logger) {}

    #[Route('/new', name: 'nouvel_soutenance', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $etudiant = new Soutenance();
        $form = $this->createForm(SoutenanceType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etudiant);
            $entityManager->flush();
            return $this->redirectToRoute('app_soutenance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soutenance/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form,
        ]);

    }

    #[Route('/{numjury}', name: 'app_soutenance_show', methods: ['GET'])]
    public function show(Soutenance $soutenance): Response
    {
        return $this->render('soutenance/show.html.twig', [
            'soutenance' => $soutenance,
        ]);
    }

    #[Route('/{numjury}/edit', name: 'app_soutenance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Soutenance $soutenance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoutenanceType::class, $soutenance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soutenance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soutenance/edit.html.twig', [
            'soutenance' => $soutenance,
            'form' => $form,
        ]);
    }

    #[Route('/{numjury}', name: 'app_soutenance_delete', methods: ['POST'])]
    public function delete(Request $request, Soutenance $soutenance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soutenance->getNumjury(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($soutenance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soutenance_index', [], Response::HTTP_SEE_OTHER);
    }
}
