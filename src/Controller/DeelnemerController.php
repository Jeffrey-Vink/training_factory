<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DeelnemerController
 * @package App\Controller
 * @Route("/deelnemer", name="lid_")
 */
class DeelnemerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('deelnemer/index.html.twig');
    }
}