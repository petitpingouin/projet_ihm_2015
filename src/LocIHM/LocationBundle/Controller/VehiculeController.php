<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LocIHM\LocationBundle\Entity\Vehicule;
use LocIHM\LocationBundle\Form\VehiculeType;

/**
 * Vehicule controller.
 *
 */
class VehiculeController extends Controller
{

    /**
     * Lists all Vehicule entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocIHMLocationBundle:Vehicule')->findAll();

        return $this->render('LocIHMLocationBundle:Vehicule:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Vehicule entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Vehicule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vehicule_show', array('id' => $entity->getId())));
        }

        return $this->render('LocIHMLocationBundle:Vehicule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Vehicule entity.
     *
     * @param Vehicule $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vehicule $entity)
    {
        $form = $this->createForm(new VehiculeType(), $entity, array(
            'action' => $this->generateUrl('vehicule_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vehicule entity.
     *
     */
    public function newAction()
    {
        $entity = new Vehicule();
        $form   = $this->createCreateForm($entity);

        return $this->render('LocIHMLocationBundle:Vehicule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vehicule entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Vehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehicule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Vehicule:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vehicule entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Vehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehicule entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:Vehicule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Vehicule entity.
    *
    * @param Vehicule $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vehicule $entity)
    {
        $form = $this->createForm(new VehiculeType(), $entity, array(
            'action' => $this->generateUrl('vehicule_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vehicule entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:Vehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehicule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vehicule_edit', array('id' => $id)));
        }

        return $this->render('LocIHMLocationBundle:Vehicule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Vehicule entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocIHMLocationBundle:Vehicule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vehicule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vehicule'));
    }

    /**
     * Creates a form to delete a Vehicule entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vehicule_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
