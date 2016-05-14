<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class CRUDController
 * @package AppBundle\Controller
 *
 * @Route("/crud")
 */
class CRUDController extends Controller
{
    /**
     * @Route("/list", name="crud_list")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function listAction()
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository('AppBundle:Troop');
        $tplVars['troops'] = $repo->findAll();

        return $tplVars;
    }

    /**
     * @Route("/edit/{id}", name="crud_edit")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository('AppBundle:Troop');
        $tplVars['troop'] = $repo->find($id);

        return $tplVars;
    }

    /**
     * @Route("/update", name="crud_update")
     * @Method("POST")
     * @Template()
     *
     * @return array
     */
    public function updateAction()
    {
        $em = $this->getDoctrine();
        $repo = $em->getRepository('AppBundle:Troop');
        $tplVars['troops'] = $repo->findAll();

        return $tplVars;
    }
}
