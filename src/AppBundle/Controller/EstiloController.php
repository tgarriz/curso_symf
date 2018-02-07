<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Estilo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Estilo controller.
 *
 * @Route("estilo")
 */
class EstiloController extends Controller
{
    /**
     * Lists all estilo entities.
     *
     * @Route("/", name="estilo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estilos = $em->getRepository('AppBundle:Estilo')->findAll();

        return $this->render('estilo/index.html.twig', array(
            'estilos' => $estilos,
        ));
    }

    /**
     * Creates a new estilo entity.
     *
     * @Route("/new", name="estilo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estilo = new Estilo();
        $form = $this->createForm('AppBundle\Form\EstiloType', $estilo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estilo);
            $em->flush();

            return $this->redirectToRoute('estilo_show', array('id' => $estilo->getId()));
        }

        return $this->render('estilo/new.html.twig', array(
            'estilo' => $estilo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a estilo entity.
     *
     * @Route("/{id}", name="estilo_show")
     * @Method("GET")
     */
    public function showAction(Estilo $estilo)
    {
        $deleteForm = $this->createDeleteForm($estilo);

        return $this->render('estilo/show.html.twig', array(
            'estilo' => $estilo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing estilo entity.
     *
     * @Route("/{id}/edit", name="estilo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Estilo $estilo)
    {
        $deleteForm = $this->createDeleteForm($estilo);
        $editForm = $this->createForm('AppBundle\Form\EstiloType', $estilo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estilo_edit', array('id' => $estilo->getId()));
        }

        return $this->render('estilo/edit.html.twig', array(
            'estilo' => $estilo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a estilo entity.
     *
     * @Route("/{id}", name="estilo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Estilo $estilo)
    {
        $form = $this->createDeleteForm($estilo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estilo);
            $em->flush();
        }

        return $this->redirectToRoute('estilo_index');
    }

    /**
     * Creates a form to delete a estilo entity.
     *
     * @param Estilo $estilo The estilo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Estilo $estilo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estilo_delete', array('id' => $estilo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
