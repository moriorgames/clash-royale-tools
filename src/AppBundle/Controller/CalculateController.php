<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// Annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 *
 * @Route("/calculate")
 */
class CalculateController extends Controller
{
    /**
     * @Route("/", name="calculate")
     * @Method("GET")
     * @Template()
     *
     * @return array
     */
    public function calculateAction()
    {
        $tplVars = [
            'troops' => [],
        ];
        $deck = $this->get('session')->get('deck');
        if (is_array($deck)) {
            $repo = $this->getDoctrine()->getRepository('AppBundle:Troop');
            $tplVars['troops'] = $repo->findByDeck($deck);
        }
        $tplVars['efficiency'] = $this->get('app.efficiency_calculator')
            ->calculateDeckEfficiency($tplVars['troops']);

        return $tplVars;
    }

    /**
     * @Route("/add_to_deck/{id}", name="add_to_deck")
     * @Method("GET")
     *
     * @param $id
     *
     * @return array
     */
    public function addToDeckAction($id)
    {
        $this->get('app.deck_session_storage')->addCardToSessionById($id);

        return $this->redirectToRoute('calculate');
    }

    /**
     * @Route("/remove_from_deck/{id}", name="remove_from_deck")
     * @Method("GET")
     *
     * @param $id
     *
     * @return array
     */
    public function removeFromDeckAction($id)
    {
        $this->get('app.deck_session_storage')->removeCardToSessionById($id);

        return $this->redirectToRoute('calculate');
    }
}
