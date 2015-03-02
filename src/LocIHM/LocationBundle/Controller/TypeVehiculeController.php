<?php

namespace LocIHM\LocationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use LocIHM\LocationBundle\Entity\TypeVehicule;
use LocIHM\LocationBundle\Form\TypeVehiculeType;

/**
 * TypeVehicule controller.
 *
 */
class TypeVehiculeController extends Controller
{

    /**
     * Lists all TypeVehicule entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LocIHMLocationBundle:TypeVehicule')->findAll();

        return $this->render('LocIHMLocationBundle:TypeVehicule:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new TypeVehicule entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new TypeVehicule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('typevehicule_show', array('id' => $entity->getId())));
        }

        return $this->render('LocIHMLocationBundle:TypeVehicule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a TypeVehicule entity.
     *
     * @param TypeVehicule $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TypeVehicule $entity)
    {
        $form = $this->createForm(new TypeVehiculeType(), $entity, array(
            'action' => $this->generateUrl('typevehicule_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TypeVehicule entity.
     *
     */
    public function newAction()
    {
        $entity = new TypeVehicule();
        $form   = $this->createCreateForm($entity);

        return $this->render('LocIHMLocationBundle:TypeVehicule:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a TypeVehicule entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:TypeVehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeVehicule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:TypeVehicule:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing TypeVehicule entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:TypeVehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeVehicule entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('LocIHMLocationBundle:TypeVehicule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a TypeVehicule entity.
    *
    * @param TypeVehicule $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TypeVehicule $entity)
    {
        $form = $this->createForm(new TypeVehiculeType(), $entity, array(
            'action' => $this->generateUrl('typevehicule_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TypeVehicule entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LocIHMLocationBundle:TypeVehicule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TypeVehicule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('typevehicule_edit', array('id' => $id)));
        }

        return $this->render('LocIHMLocationBundle:TypeVehicule:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a TypeVehicule entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LocIHMLocationBundle:TypeVehicule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TypeVehicule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('typevehicule'));
    }

    /**
     * Creates a form to delete a TypeVehicule entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typevehicule_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
