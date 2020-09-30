<?php

namespace App\Controller;

use App\Repository\BaseRepository;
use App\Repository\MemoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(BaseRepository $baseRepository, MemoRepository $memoRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'bedrijf' => $baseRepository->findOneBy([],[]),
            'memo' => $memoRepository->findOneBy(['titel' => 'homepage']),
        ]);
    }
}