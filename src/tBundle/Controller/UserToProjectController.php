<?php

namespace tBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use tBundle\Entity\UserToProject;
use tBundle\Form\UserToProjectType;

/**
 * UserToProject controller.
 *
 * @Route("/usertoproject")
 */
class UserToProjectController extends Controller
{

    /**
     * Lists all UserToProject entities.
     *
     * @Route("/", name="usertoproject")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('tBundle:UserToProject')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new UserToProject entity.
     *
     * @Route("/", name="usertoproject_create")
     * @Method("POST")
     * @Template("tBundle:UserToProject:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new UserToProject();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usertoproject_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a UserToProject entity.
     *
     * @param UserToProject $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(UserToProject $entity)
    {
        $form = $this->createForm(new UserToProjectType(), $entity, array(
            'action' => $this->generateUrl('usertoproject_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new UserToProject entity.
     *
     * @Route("/new", name="usertoproject_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserToProject();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserToProject entity.
     *
     * @Route("/{id}", name="usertoproject_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToProject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserToProject entity.
     *
     * @Route("/{id}/edit", name="usertoproject_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToProject entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a UserToProject entity.
    *
    * @param UserToProject $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(UserToProject $entity)
    {
        $form = $this->createForm(new UserToProjectType(), $entity, array(
            'action' => $this->generateUrl('usertoproject_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing UserToProject entity.
     *
     * @Route("/{id}", name="usertoproject_update")
     * @Method("PUT")
     * @Template("tBundle:UserToProject:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('tBundle:UserToProject')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserToProject entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usertoproject_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a UserToProject entity.
     *
     * @Route("/{id}", name="usertoproject_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('tBundle:UserToProject')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserToProject entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usertoproject'));
    }

    /**
     * Creates a form to delete a UserToProject entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usertoproject_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
