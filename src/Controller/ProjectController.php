<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/', name: 'app_project_index', methods: ['GET'])]
    public function index(ProjectRepository $projectRepository, SerializerInterface $serializer): Response
    {
        $projects = $projectRepository->findAll();
        $jsonData = $serializer->serialize($projects, 'json');

        return new Response($jsonData, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/new', name: 'app_project_new', methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $data = json_decode($request->getContent(), true);

        $project = new Project();
        $project->setCategorie($data['Categorie'] ?? '')
            ->setStatus($data['status'] ?? '')
            ->setTitle($data['title'] ?? '')
            ->setDescription($data['description'] ?? '')
            ->setDate(new \DateTime($data['date'] ?? 'now'))
            ->setTasks($data['tasks'] ?? 0)
            ->setComments($data['comments'] ?? 0)
            ->setProgress($data['progress'] ?? 0);

        $entityManager->persist($project);
        $entityManager->flush();

        return new Response($serializer->serialize($project, 'json'), Response::HTTP_CREATED, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'app_project_show', methods: ['GET'])]
    public function show(Project $project, SerializerInterface $serializer): Response
    {
        return new Response($serializer->serialize($project, 'json'), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}/edit', name: 'app_project_edit', methods: ['PUT'])]
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $data = json_decode($request->getContent(), true);

        $project->setCategorie($data['Categorie'] ?? $project->getCategorie())
            ->setStatus($data['status'] ?? $project->getStatus())
            ->setTitle($data['title'] ?? $project->getTitle())
            ->setDescription($data['description'] ?? $project->getDescription())
            ->setDate(new \DateTime($data['date'] ?? $project->getDate()->format('Y-m-d H:i:s')))
            ->setTasks($data['tasks'] ?? $project->getTasks())
            ->setComments($data['comments'] ?? $project->getComments())
            ->setProgress($data['progress'] ?? $project->getProgress());

        $entityManager->flush();

        return new Response($serializer->serialize($project, 'json'), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route('/{id}', name: 'app_project_delete', methods: ['DELETE'])]
    public function delete(Project $project, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($project);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
