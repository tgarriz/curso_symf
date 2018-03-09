<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pedido;
use AppBundle\Entity\PedidoCerveza;
use AppBundle\Entity\Cliente;


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
        //var_dump($request->request->get("delivery"));
        $pedidos = json_decode($request->request->get("delivery"));
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('AppBundle:Cliente')->find(1);

        $pedido = new Pedido();
        $pedido->setFecha(new \Datetime("now"));
        $pedido->setCliente($cliente);

        foreach ($pedidos as $p) {
          $cerveza = $em->getReference('AppBundle:Cerveza', $p->cervezaId);

          $pedidoCerveza = new PedidoCerveza();
          $pedidoCerveza->setCantidad($p->cantidad);
          $pedidoCerveza->setCerveza($cerveza);
          $pedidoCerveza->setPedido($pedido);
          $pedido->addPedidoCervezas($pedidoCerveza);
        }

        $em->persist($pedido);
        $em->flush();

        return $this->render('delivery/finalizarPedido.html.twig', [
            //'cervezas' => $cervezas
        ]);
    }


}
