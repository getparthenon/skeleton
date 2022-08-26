<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class FrontendController
{
    #[Route('/', name: 'app_index_landing', requirements: ['vueRouting' => '.+'], defaults: ['vueRouting' => null])]
    public function home(Environment $twig)
    {
        return new Response($twig->render('index.html.twig'));
    }
}
