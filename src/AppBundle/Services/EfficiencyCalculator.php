<?php

namespace AppBundle\Services;

use AppBundle\Entity\Troop;
use CoreBundle\Constants;

/**
 * Class EfficiencyCalculator
 * @package AppBundle\Services
 */
class EfficiencyCalculator
{
    /**
     * @param array $troops
     *
     * @return array
     */
    public function calculateDeckEfficiency(array $troops = [])
    {
        $efficiency = [
            'elixir'          => 0,
            'hitPoints'       => 0,
            'groundDamage'    => 0,
            'airDamage'       => 0,
            'structureDamage' => 0,
        ];
        $elixir = [];
        $hitPoints = [];
        $groundDamage = [];
        $airDamage = [];
        $structureDamage = [];

        /** @var Troop $troop */
        foreach ($troops as $troop) {
            $elixir[] = $troop->getCost();
            $hitPoints[] = $this->hitPointsEfficiency($troop);
            $groundDamage[] = $this->groundDamageEfficiency($troop);
            $airDamage[] = $this->airDamageEfficiency($troop);
            $structureDamage[] = $this->structureDamageEfficiency($troop);
        }

        if ($hitPoints) {
            $efficiency = [
                'elixir'          => $this->arrayAverage($elixir),
                'hitPoints'       => $this->arrayAverage($hitPoints),
                'groundDamage'    => $this->arrayAverage($groundDamage),
                'airDamage'       => $this->arrayAverage($airDamage),
                'structureDamage' => $this->arrayAverage($structureDamage),
            ];
        }

        return $efficiency;
    }

    /**
     * @param Troop $troop
     *
     * @return float
     */
    private function hitPointsEfficiency(Troop $troop)
    {
        return ($troop->getHitPoints() * $troop->getUnits()) / $troop->getCost();
    }

    /**
     * @param Troop $troop
     *
     * @return float
     */
    private function groundDamageEfficiency(Troop $troop)
    {
        $target = $troop->getTarget();

        return (
            $target === Constants::BATTLE_ENTITY_TARGET_GROUND_AIR ||
            $target === Constants::BATTLE_ENTITY_TARGET_GROUND
        ) ?
            ($troop->getDps() * $troop->getUnits()) / $troop->getCost() :
            0;
    }

    /**
     * @param Troop $troop
     *
     * @return float
     */
    private function airDamageEfficiency(Troop $troop)
    {
        $target = $troop->getTarget();

        return (
            $target === Constants::BATTLE_ENTITY_TARGET_GROUND_AIR
        ) ?
            ($troop->getDps() * $troop->getUnits()) / $troop->getCost() :
            0;
    }

    /**
     * @param Troop $troop
     *
     * @return float
     */
    private function structureDamageEfficiency(Troop $troop)
    {
        $target = $troop->getTarget();

        return (
            $target === Constants::BATTLE_ENTITY_TARGET_GROUND_AIR ||
            $target === Constants::BATTLE_ENTITY_TARGET_GROUND ||
            $target === Constants::BATTLE_ENTITY_TARGET_BUILDINGS
        ) ?
            ($troop->getDps() * $troop->getUnits()) / $troop->getCost() :
            0;
    }

    /**
     * @param array $array
     *
     * @return float
     */
    private function arrayAverage(array $array = [])
    {
        return round(array_sum($array) / count($array), 2);
    }
}
