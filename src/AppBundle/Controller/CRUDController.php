<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Troop;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
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
     * @param $id
     *
     * @return array
     */
    public function editAction($id)
    {
        $troop = $this->findTroopById($id);
        if (!$troop instanceof Troop) {
            $troop = new Troop();
        }

        return ['troop' => $troop];
    }

    /**
     * @Route("/update", name="crud_update")
     * @Method("POST")
     *
     * @param Request $request
     *
     * @return array
     */
    public function updateAction(Request $request)
    {
        $parameters = $request->request;

        if (is_numeric($parameters->get('id'))) {
            $troop = $this->findTroopById($parameters->get('id'));
        } else {
            $troop = new Troop();
        }

        $this->persistTroop($parameters, $troop);

        return $this->redirectToRoute('crud_edit', ['id' => $troop->getId()]);
    }

    /**
     * @param $id
     *
     * @return Troop
     */
    private function findTroopById($id)
    {
        return $this->getDoctrine()
            ->getRepository('AppBundle:Troop')
            ->find($id);
    }

    /**
     * @param       $parameters
     * @param Troop $troop
     */
    private function persistTroop(ParameterBag $parameters, Troop $troop)
    {
        $troop
            ->setName($parameters->get('name'))
            ->setBattleEntityType($parameters->get('battleEntityType'))
            ->setLevel($parameters->get('level'))
            ->setHitPoints($parameters->get('hitPoints'))
            ->setDps($parameters->get('dps'))
            ->setDamage($parameters->get('damage'))
            ->setSpeed($parameters->get('speed'))
            ->setTarget($parameters->get('target'))
            ->setHitSpeed($parameters->get('hitSpeed'))
            ->setRange($parameters->get('range'))
            ->setCost($parameters->get('cost'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($troop);
        $em->flush();
    }
}
