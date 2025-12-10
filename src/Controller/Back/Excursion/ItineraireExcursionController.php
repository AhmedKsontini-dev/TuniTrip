<?php

namespace App\Controller\Back\Excursion;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Excursion;
use App\Entity\ItineraireExcursion;
use App\Form\ItineraireExcursionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ItineraireExcursionController extends AbstractController
{
    #[Route('/itineraire/new/{id}', name: 'itineraire_new')]
    public function new(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $excursion = $entityManager->getRepository(Excursion::class)->find($id);

        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée');
        }

        $itineraire = new ItineraireExcursion();
        $itineraire->setExcursion($excursion);

        $form = $this->createForm(ItineraireExcursionType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handlePhotos($form, $itineraire);

            $entityManager->persist($itineraire);
            $entityManager->flush();

            $this->addFlash('success', 'Itinéraire ajouté avec succès !');

            return $this->redirectToRoute('itineraire_new', ['id' => $excursion->getId()]);
        }

        return $this->render('Back/excursion_details/itineraire.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
            'itineraire' => $itineraire,
        ]);
    }

    #[Route('/itineraire/edit/{id}', name: 'itineraire_edit')]
    public function edit(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $excursion = $entityManager->getRepository(Excursion::class)->find($id);

        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée');
        }

        // On récupère l'itinéraire existant de l'excursion
        $itineraire = $entityManager->getRepository(ItineraireExcursion::class)
            ->findOneBy(['excursion' => $excursion]);

        if (!$itineraire) {
            $this->addFlash('warning', 'Aucun itinéraire existant, veuillez en créer un.');
            return $this->redirectToRoute('itineraire_new', ['id' => $excursion->getId()]);
        }

        $form = $this->createForm(ItineraireExcursionType::class, $itineraire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handlePhotos($form, $itineraire);

            $entityManager->flush();

            $this->addFlash('success', 'Itinéraire modifié avec succès !');

            return $this->redirectToRoute('admin_excursion_index');
        }

        return $this->render('Back/excursion_details/itineraire.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
            'itineraire' => $itineraire,
        ]);
    }

    /**
     * Méthode privée pour gérer l'upload des photos
     */
    private function handlePhotos($form, ItineraireExcursion $itineraire)
    {
        $uploadsDirectory = $this->getParameter('uploads_directory'); // défini dans services.yaml
        foreach ($form->get('photos') as $photoForm) {
            $photo = $photoForm->getData(); // ItinerairePhoto
            $file = $photoForm->get('imageFile')->getData(); // champ FileType

            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move($uploadsDirectory, $fileName);
                    $photo->setImageUrl($fileName); // stocke le nom du fichier dans la DB
                    $itineraire->addPhoto($photo);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload de l\'image.');
                }
            }
        }
    }

    #[Route('/itineraire/table/{id}', name: 'itineraire_table')]
    public function table(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $excursion = $entityManager->getRepository(Excursion::class)->find($id);

        if (!$excursion) {
            throw $this->createNotFoundException('Excursion non trouvée');
        }

        // Récupère toutes les étapes de l'excursion
        $itineraires = $entityManager->getRepository(ItineraireExcursion::class)
            ->findBy(['excursion' => $excursion], ['ordre' => 'ASC']);

        return $this->render('Back/excursion_details/itineraire_table.html.twig', [
            'excursion' => $excursion,
            'itineraires' => $itineraires,
        ]);
    }

    #[Route('/itineraire/delete/{id}', name: 'itineraire_delete', methods: ['POST'])]
    public function delete(Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $itineraire = $entityManager->getRepository(ItineraireExcursion::class)->find($id);

        if (!$itineraire) {
            throw $this->createNotFoundException('Itinéraire non trouvé');
        }

        if ($this->isCsrfTokenValid('delete'.$itineraire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($itineraire);
            $entityManager->flush();
            $this->addFlash('success', 'Itinéraire supprimé avec succès !');
        }

        return $this->redirectToRoute('itineraire_table', ['id' => $itineraire->getExcursion()->getId()]);
    }
}
