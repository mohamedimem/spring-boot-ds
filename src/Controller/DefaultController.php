<?php

namespace App\Controller;

use App\Entity\Enseignant;
use App\Form\EnseignantType;
use App\Repository\EnseignantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
      public function showStatistics(): Response
    {
        // Example logic for fetching data (adjust queries to your database or models)
        $studentCount = 1000; // Replace with actual logic to get the student count
        $teacherCount = 150; // Replace with actual logic to get the teacher count
        $defenseCount = 30; // Replace with actual logic to get the number of defenses

        // Render the statistics page with the data
        return $this->render('stat.html.twig', [
            'students' => $studentCount,
            'teachers' => $teacherCount,
            'defenses' => $defenseCount,
        ]);
    }
      //  return $this->render('base.html.twig');

}