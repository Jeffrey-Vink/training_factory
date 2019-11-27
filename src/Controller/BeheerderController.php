<?php
namespace App\Controller;

use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Training;
use App\Form\TrainingType;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BeheerderController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class BeheerderController extends AbstractController
{
    /**
     * @Route("/", name="training_index", methods={"GET"})
     */
    public function index(TrainingRepository $trainingRepository): Response
    {
        return $this->render('beheerder/training/index.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="training_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('admin_training_index');
        }

        return $this->render('beheerder/training/new.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="training_show", methods={"GET"})
     */
    public function show(Training $training): Response
    {
        return $this->render('beheerder/training/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
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

            return $this->redirectToRoute('admin_training_index');
        }
        return $this->render('beheerder/details.html.twig', [
            'trainingForm' => $form->createView(),
            'image' => $training->getImageFilename(),
        ]);
    }

    /**
     * @Route("/{id}", name="training_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Training $training): Response
    {
        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_training_index');
    }
//    /**
//     * @Route("/trainingen", name="beheerder_trainingen", methods={"GET"})
//     */
//    public function trainingAanbod(EntityManagerInterface $em)
//    {
//        $repository = $em->getRepository(Training::class);
//        $trainingen = $repository->findAll();
//
//        return $this->render('beheerder/activiteiten.html.twig', [
//            'trainingen' => $trainingen,
//        ]);
//    }
//
//    /**
//     * @Route("/admin/trainingen", name="beheerder_training_delete", methods={"POST"})
//     */
//    public function trainingDeleteAction(EntityManagerInterface $em, Request $request)
//    {
//        $training = $request->get('delete');
//        $trainingId = $training;
//
//        $repository = $em->getRepository(Training::class);
//        $em->remove($repository->find($training));
//        $em->flush();
//        $trainingen = $repository->findAll();
//
//        $this->addFlash('deleted', 'Training '.$trainingId.' succesvol verwijderd!');
//
//        return $this->render('beheerder/index.html.twig', [
//            'training' => $trainingId,
//            'trainingen' => $trainingen,
//        ]);
//    }
//
//    /**
//     * @Route("/admin/training/{training}/edit", name="beheerder_training_edit")
//     */
//    public function trainingEditAction(Training $training, Request $request, EntityManagerInterface $em)
//    {
//        $form = $this->createForm(TrainingType::class, $training);
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            /** @var UploadedFile $uploadedFile */
//            $uploadedFile = $form['imageFile']->getData();
//            if ($uploadedFile) {
//                $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
//                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
//                $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
//                $uploadedFile->move(
//                    $destination,
//                    $newFilename
//                );
//                $training->setImageFilename($newFilename);
//            }
//            $em->persist($training);
//            $em->flush();
//
//            $this->addFlash('success', 'Training succesvol geupdatet!');
//
//            return $this->redirectToRoute('beheerder_trainingen');
//        }
//        return $this->render('beheerder/details.html.twig', [
//            'trainingForm' => $form->createView(),
//            'image' => $training->getImageFilename(),
//        ]);
//    }
}