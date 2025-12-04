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

            // Gestion des photos uploadées
            foreach ($form->get('photos') as $photoForm) {
                $photo = $photoForm->getData(); // ItinerairePhoto
                $file = $photoForm->get('imageFile')->getData(); // champ FileType

                if ($file) {
                    $uploadsDirectory = $this->getParameter('uploads_directory'); // défini dans services.yaml
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

            $entityManager->persist($itineraire);
            $entityManager->flush();

            $this->addFlash('success', 'Itinéraire ajouté avec succès !');

            // redirection vers la page de détail de l’excursion
            return $this->redirectToRoute('admin_excursion_index');
        }

        return $this->render('Back/excursion_details/itineraire.html.twig', [
            'form' => $form->createView(),
            'excursion' => $excursion,
        ]);
    }
}
