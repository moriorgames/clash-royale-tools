<?php

namespace AppBundle\Entity;

use CoreBundle\Constants;
use UnexpectedValueException;
use Doctrine\ORM\Mapping as ORM;
use CoreBundle\Entity\Traits\NameSlugTrait;
use CoreBundle\Entity\Traits\BattleEntityTrait;
use CoreBundle\Entity\Traits\IdentifiableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Troop.
 *
 * @ORM\Entity
 * @ORM\Table(name="troop")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TroopRepository")
 */
class Troop
{
    use IdentifiableTrait;
    use NameSlugTrait;
    use BattleEntityTrait;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $hitSpeed;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="general.blank")
     */
    private $target;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="general.blank")
     */
    private $speed;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $range;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", options={"default"=0})
     * @Assert\Type(type="integer")
     */
    private $cost;

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     *
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getHitSpeed()
    {
        return $this->hitSpeed;
    }

    /**
     * @param int $hitSpeed
     *
     * @return $this
     */
    public function setHitSpeed($hitSpeed)
    {
        $this->hitSpeed = $hitSpeed;

        return $this;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget($target)
    {
        if (!in_array($target, Constants::BATTLE_ENTITY_TARGETS)) {
            throw new UnexpectedValueException('This Battle entity is not allowed');
        }
        $this->target = $target;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param string $speed
     *
     * @return $this
     */
    public function setSpeed($speed)
    {
        if (!in_array($speed, Constants::BATTLE_ENTITY_MOVEMENTS)) {
            throw new UnexpectedValueException('This Battle entity is not allowed');
        }
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return int
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param int $range
     *
     * @return $this
     */
    public function setRange($range)
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     *
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }
}
