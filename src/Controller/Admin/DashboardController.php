<?php

namespace App\Controller\Admin;

use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Soutenance;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MiniProjet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Etudiants', 'fa fa-home');
        yield MenuItem::linkToCrud('Listes des Etudiants', 'fas fa-list', Etudiant::class);
        yield MenuItem::section('Enseignant', 'fa fa-home');
        yield MenuItem::linkToCrud('Listes des Enseignant', 'fas fa-list', Enseignant::class);
        yield MenuItem::section('Soutenances', 'fa fa-home');
        yield MenuItem::linkToCrud('Listes des soutenances', 'fas fa-list', Soutenance::class);
    }
}
