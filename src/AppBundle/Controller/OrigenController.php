<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Origen;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Origen controller.
 *
 * @Route("origen")
 */
class OrigenController extends Controller
{
    /**
     * Lists all origen entities.
     *
     * @Route("/", name="origen_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $origens = $em->getRepository('AppBundle:Origen')->findAll();

        return $this->render('origen/index.html.twig', array(
            'origens' => $origens,
        ));
    }

    /**
     * Creates a new origen entity.
     *
     * @Route("/new", name="origen_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $origen = new Origen();
        $form = $this->createForm('AppBundle\Form\OrigenType', $origen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($origen);
            $em->flush();
            //Crea un mensaje de session Flash que se mostrará en la página.
            $this->addFlash(
               'notice',
               'origen agregado con éxito.'
            );
            return $this->redirectToRoute('origen_index');
        }

        return $this->render('origen/new.html.twig', array(
            'origen' => $origen,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a origen entity.
     *
     * @Route("/{id}", name="origen_show")
     * @Method("GET")
     */
    public function showAction(Origen $origen)
    {
        $deleteForm = $this->createDeleteForm($origen);

        return $this->render('origen/show.html.twig', array(
            'origen' => $origen,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing origen entity.
     *
     * @Route("/{id}/edit", name="origen_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Origen $origen)
    {
        $deleteForm = $this->createDeleteForm($origen);
        $editForm = $this->createForm('AppBundle\Form\OrigenType', $origen);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //Crea un mensaje de session Flash que se mostrará en la página.
            $this->addFlash(
               'notice',
               'origen editado con éxito.'
            );
            return $this->redirectToRoute('origen_index');
        }

        return $this->render('origen/edit.html.twig', array(
            'origen' => $origen,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a origen entity.
     *
     * @Route("/{id}", name="origen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Origen $origen)
    {
        $form = $this->createDeleteForm($origen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($origen);
            $em->flush();
        }

        //Crea un mensaje de session Flash que se mostrará en la página.
        $this->addFlash(
           'notice',
           'origen eliminado con éxito.'
        );
        return $this->redirectToRoute('origen_index');
    }

    /**
     * Creates a form to delete a origen entity.
     *
     * @param Origen $origen The origen entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Origen $origen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('origen_delete', array('id' => $origen->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
