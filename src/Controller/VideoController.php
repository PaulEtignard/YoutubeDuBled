<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\AuteurRepository;
use App\Repository\VideoRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    private VideoRepository $videoRepository;
    private AuteurRepository $auteurRepository;

    public function __construct(VideoRepository $videoRepository, AuteurRepository $auteurRepository)
    {
        $this->videoRepository = $videoRepository;
        $this->auteurRepository = $auteurRepository;
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

    #[Route('/video/nouveau', name: 'app_video_insert', methods: ['GET','POST'],priority: 1)]

    public function insert(Request $request): Response
    {

        $faker = Factory::create("fr_FR");
        $video = new Video();
        // Création du formulaire
        $formVideo = $this->createForm(VideoType::class,$video);
        $formVideo->handleRequest($request);
        if ($formVideo->isSubmitted()) {
            $auteur = $this->auteurRepository->findOneBy([],["nom"=>"ASC"]);
            $video->setCreatedAt(new \DateTime())
                ->setAuteur($auteur);
            $this->videoRepository->save($video,"true");
            return $this->redirectToRoute("app_videos");
        }
        return $this->render('video/nouveau.html.twig', [
            'formVideo' => $formVideo
        ]);
    }


}
