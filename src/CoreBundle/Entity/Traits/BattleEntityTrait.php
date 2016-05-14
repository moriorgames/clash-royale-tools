<?php

namespace CoreBundle\Entity\Traits;

use CoreBundle\Constants;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;

/**
 * Class FighterTrait.
 */
trait BattleEntityTrait
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $damage;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $dps;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $hitPoints;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="general.blank")
     */
    private $battleEntityType;

    /**
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * @param int $damage
     *
     * @return $this
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * @return int
     */
    public function getDps()
    {
        return $this->dps;
    }

    /**
     * @param int $dps
     *
     * @return $this
     */
    public function setDps($dps)
    {
        $this->dps = $dps;

        return $this;
    }

    /**
     * @return int
     */
    public function getRange()
    {
        return $this->dps;
    }

    /**
     * @param int $dps
     *
     * @return $this
     */
    public function setRange($dps)
    {
        $this->dps = $dps;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitPoints()
    {
        return $this->hitPoints;
    }

    /**
     * @param int $hitPoints
     *
     * @return $this
     */
    public function setHitPoints($hitPoints)
    {
        $this->hitPoints = $hitPoints;

        return $this;
    }

    /**
     * @return string
     */
    public function getBattleEntityType()
    {
        return $this->battleEntityType;
    }

    /**
     * @param string $battleEntityType
     *
     * @return $this
     */
    public function setBattleEntityType($battleEntityType)
    {
        if (!in_array($battleEntityType, Constants::BATTLE_ENTITY_TYPES)) {
            throw new UnexpectedValueException('This Battle entity is not allowed');
        }
        $this->battleEntityType = $battleEntityType;

        return $this;
    }
}
