<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cerveza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Cerveza controller.
 *
 * @Route("cerveza")
 */
class CervezaController extends Controller
{
    /**
     * Lists all cerveza entities.
     *
     * @Route("/", name="cerveza_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cervezas = $em->getRepository('AppBundle:Cerveza')->findAll();

        return $this->render('cerveza/index.html.twig', array(
            'cervezas' => $cervezas,
        ));
    }

    /**
     * Lists all cerveza entities.
     *
     * @Route("/order/{campo}/{ord}", name="cerveza_index_order")
     * @Method({"GET", "POST"})
     */
    public function indexActionOrder(String $campo, String $ord)
    {
        $em = $this->getDoctrine()->getManager();
        $cervezas = $em->getRepository('AppBundle:Cerveza')->findBy(array(),array($campo=>$ord));
        return $this->render('cerveza/index.html.twig', array(
            'cervezas' => $cervezas,
        ));
    }
     /**
       * Creates a new cerveza entity.
       *
       * @Route("/new", name="cerveza_new")
       * @Method({"GET", "POST"})
       */
      public function newAction(Request $request)
      {
          $cerveza = new Cerveza();
          $form = $this->createForm('AppBundle\Form\CervezaType', $cerveza);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
              $em = $this->getDoctrine()->getManager();


              $formFiles = $request->files;
              if(!is_null($formFiles->get('appbundle_cerveza')['foto'])){
                // $file guarda la imagen
                $file = $cerveza->getFoto();
                // Genera un nombre unico antes de guardar
                $fileName = sha1(uniqid()).'.'.$file->guessExtension();
                // Mueve el erchivo al directorio uploads
                $file->move(
                    $this->getParameter('upload_dir'),
                    $fileName
                );


                // Actualiza la propiedad Foto con el nuevo nombre del archivo
                $cerveza->setFoto($fileName);

                $em->persist($cerveza);
                $em->flush();
             }
              //Crea un mensaje de session Flash que se mostrará en la página.
                $this->addFlash(
                  'success',
                  'Cerveza agregada con éxito.'
                );
                return $this->redirectToRoute('cerveza_index');
          }
          elseif ($form->isSubmitted() && !$form->isValid()) {
            $this->addFlash(
                'danger',
                'Error al agregar el Cerveza.'
            );
          }

          return $this->render('cerveza/new.html.twig', array(
              'cerveza' => $cerveza,
              'form' => $form->createView(),
          ));
      }
    /**
     * Finds and displays a cerveza entity.
     *
     * @Route("/{id}", name="cerveza_show")
     * @Method("GET")
     */
    public function showAction(Cerveza $cerveza)
    {
        $deleteForm = $this->createDeleteForm($cerveza);

        return $this->render('cerveza/show.html.twig', array(
            'cerveza' => $cerveza,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cerveza entity.
     *
     * @Route("/{id}/edit", name="cerveza_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cerveza $cerveza)
    {
        $deleteForm = $this->createDeleteForm($cerveza);
        $editForm = $this->createForm('AppBundle\Form\CervezaType', $cerveza);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //Crea un mensaje de session Flash que se mostrará en la página.
           $this->addFlash(
               'success',
               'Cerveza guardada con éxito.'
           );

            return $this->redirectToRoute('cerveza_index');
        }
        elseif ($editForm->isSubmitted() && !$editForm->isValid()) {
          $this->addFlash(
              'danger',
              'Error al editar el Cerveza.'
          );
        }

        return $this->render('cerveza/edit.html.twig', array(
            'cerveza' => $cerveza,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cerveza entity.
     *
     * @Route("/{id}", name="cerveza_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cerveza $cerveza)
    {
        $form = $this->createDeleteForm($cerveza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cerveza);
            $em->flush();

            //Crea un mensaje de session Flash que se mostrará en la página.
           $this->addFlash(
               'notice',
               'Cerveza borrada con éxito.'
           );
        }

        return $this->redirectToRoute('cerveza_index');
    }

    /**
     * Creates a form to delete a cerveza entity.
     *
     * @param Cerveza $cerveza The cerveza entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cerveza $cerveza)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cerveza_delete', array('id' => $cerveza->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
    * @Route("/cervezas/all", options={"expose"=true}, name="cervezas_get_all")
    */
    public function getCervezasAll(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $aSelecionar = $request->query->get('select');

        if ($aSelecionar == 'todas') {
            $cervezas = $em->getRepository('AppBundle:Cerveza')->findAll();
        }elseif($aSelecionar == 'destacadas') {
            $cervezas = $em->getRepository('AppBundle:Cerveza')->getDestacadas();
        }else{
            $origen = $em->getRepository('AppBundle:Origen')->find($aSelecionar);
            $cervezas = $em->getRepository('AppBundle:Cerveza')->getPorOrigen($origen);
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        // Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $cervezasTojson = $serializer->serialize($cervezas, 'json');
        return new JsonResponse($cervezasTojson);

    }

}
