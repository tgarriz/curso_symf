<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeliveryController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $origenes = $em->getRepository('AppBundle:Origen')->findAll();

        return $this->render('delivery/index.html.twig', [
            'origenes' => $origenes
         ]);
    }

    /**
     * @Route("/catalogo", name="homepage_catalogo")
     */
    public function catalogoAction(Request $request)
    {
        return $this->render('delivery/catalogo.html.twig', [ ]);
    }


    /**
     * @Route("/finalizar", name="finalizar")
     * @Method("POST")
     */
    public function finalizarAction(Request $request)
    {
        var_dump($request->request->get("delivery"));
        return $this->render('delivery/finalizarPedido.html.twig', [
            //'cervezas' => $cervezas
        ]);
    }


}
