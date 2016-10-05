<?php

namespace AnalyzerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AnalyzerHomeController extends Controller
{
    /**
     * @Route("/Index")
     */
    public function IndexAction()
    {
        return $this->render('AnalyzerBundle:AnalyzerHome:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Help")
     */
    public function HelpAction()
    {
        return $this->render('AnalyzerBundle:AnalyzerHome:help.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/SaveOfficialData")
     */
    public function SaveOfficialDataAction()
    {
        return $this->render('AnalyzerBundle:AnalyzerHome:save_official_data.html.twig', array(
            // ...
        ));
    }

}
