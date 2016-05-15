<?php

namespace AppBundle\Services;

use AppBundle\Entity\Troop;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class DeckSessionStorage
 * @package AppBundle\Services
 */
class DeckSessionStorage
{
    const MAX_CARDS = 8;

    /**
     * @var Session
     */
    private $session;
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * DeckSessionStorage constructor.
     *
     * @param Session       $session
     * @param EntityManager $entityManager
     */
    public function __construct(Session $session, EntityManager $entityManager)
    {
        $this->session = $session;
        $this->em = $entityManager;
    }

    /**
     * @param $id
     *
     * @throws \OverflowException
     */
    public function addCardToSessionById($id)
    {
        $troop = $this->em->getRepository('AppBundle:Troop')->find($id);

        if ($troop instanceof Troop) {

            $deck = $this->session->get('deck');
            if (is_array($deck)) {
                $deck = array_merge($deck, [$id]);
                $deck = array_unique($deck);
                if (count($deck) <= self::MAX_CARDS) {
                    $this->session->set('deck', $deck);
                } else {
                    throw new \OverflowException('You have set the maximum of cards on the session deck');
                }
            } else {
                $this->session->set('deck', [$id]);
            }
        }
    }

    /**
     * @param $id
     *
     * @throws \OverflowException
     */
    public function removeCardToSessionById($id)
    {
        $troop = $this->em->getRepository('AppBundle:Troop')->find($id);

        if ($troop instanceof Troop) {

            $deck = $this->session->get('deck');
            if (is_array($deck)) {

                if(($key = array_search($id, $deck)) !== false) {
                    unset($deck[$key]);
                }
                
                if (count($deck) <= self::MAX_CARDS) {
                    $this->session->set('deck', $deck);
                } else {
                    throw new \OverflowException('You have set the maximum of cards on the session deck');
                }
            } else {
                $this->session->set('deck', [$id]);
            }
        }
    }
}
