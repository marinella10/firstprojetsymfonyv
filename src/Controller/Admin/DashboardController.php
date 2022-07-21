<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Distributeur;
use App\Entity\Produits;
use App\Entity\References;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
       $routeBuilder = $this->get(AdminUrlGenerator::class);
       return  $this->redirect($routeBuilder->setController(ProduitsCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Firstprojectsymfony');


    }

    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        return[
            MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home'),

            MenuItem::section('Produits'),
            MenuItem::linkToCrud('Produits', 'fa fa-user', Produits::class),

            MenuItem::section('Catégories'),
            MenuItem::linkToCrud('Catégories', 'fa fa-user', Categories::class),


            MenuItem::section('Distributeur'),
            MenuItem::linkToCrud('Distributeur', 'fa fa-user', Distributeur::class),

            MenuItem::section('Références'),
            MenuItem::linkToCrud('Références', 'fa fa-user', References::class),

            MenuItem::section('user'),
            MenuItem::linkToCrud('User', 'fa fa-user', User::class),

        ];


    }
}
