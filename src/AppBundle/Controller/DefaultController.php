<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:default:index.html.twig');
    }

    /**
     * @Route("/about", name="aboutus")
     */
    public function aboutusAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:default:about-us.html.twig');
    }

    /**
     * @Route("/ask", name="ask")
     */
    public function askAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:default:Ask.html.twig');
    }
}
