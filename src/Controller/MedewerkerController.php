<?php
namespace App\Controller;
use App\Entity\Training;
use App\Form\TrainingType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MedewerkerController extends AbstractController
{
    /**
     * @Route("/admin", name="medewerker_home")
     */
    public function homepagina()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/admin/trainingen", name="medewerker_trainingen")
     */
    public function trainingAanbod(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Training::class);
        /** @var trainingen Training */
        $trainingen = $repository->findAll();

        return $this->render('medewerker/activiteiten.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }

    /**
     * @Route("/admin/training/{training}/edit", name="medewerker_training_edit")
     */
    public function trainingEditAction(Training $training, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if($uploadedFile){
                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );
                $training->setImageFilename($newFilename);
            }

            $em->persist($training);
            $em->flush();

            $this->addFlash('success', 'Training succesvol geupdatet!');

            return $this->redirectToRoute('medewerker_trainingen');
        }
        return $this->render('medewerker/details.html.twig', [
            'trainingForm' => $form->createView(),
            'image' => $training->getImageFilename(),
        ]);
    }
}