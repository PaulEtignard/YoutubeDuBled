<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    private VideoRepository $videoRepository;

    /**
     * @param VideoRepository $videoRepository
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }


    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('video/index.html.twig', [

        ]);
    }
    #[Route('/videos', name: 'app_videos')]
    public function videos(): Response
    {
        $videos = $this->videoRepository->findAll();
        return $this->render('video/videos.html.twig', [
            'videos' => $videos,
        ]);
    }
}
