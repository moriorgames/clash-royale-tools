<?php

namespace CoreBundle;

/**
 * Class Constants.
 */
final class Constants
{
    /**
     * Troops type
     */
    const BATTLE_ENTITY_TYPE_TROOP = 'TROOP';

    const BATTLE_ENTITY_TYPE_BUILDING = 'BUILDING';

    const BATTLE_ENTITY_TYPES = [
        self::BATTLE_ENTITY_TYPE_TROOP,
        self::BATTLE_ENTITY_TYPE_BUILDING,
    ];

    /**
     * Movements
     */
    const BATTLE_ENTITY_MOVEMENT_SLOW = 'SLOW';

    const BATTLE_ENTITY_MOVEMENT_MEDIUM = 'MEDIUM';

    const BATTLE_ENTITY_MOVEMENT_FAST = 'FAST';

    const BATTLE_ENTITY_MOVEMENT_VERY_FAST = 'VERY_FAST';

    const BATTLE_ENTITY_MOVEMENTS = [
        self::BATTLE_ENTITY_MOVEMENT_SLOW,
        self::BATTLE_ENTITY_MOVEMENT_MEDIUM,
        self::BATTLE_ENTITY_MOVEMENT_FAST,
        self::BATTLE_ENTITY_MOVEMENT_VERY_FAST,
    ];

    /**
     * Damage target on battle
     */
    const BATTLE_ENTITY_TARGET_GROUND = 'GROUND';

    const BATTLE_ENTITY_TARGET_BUILDINGS = 'BUILDINGS';

    const BATTLE_ENTITY_TARGET_GROUND_AIR = 'GROUND & AIR';

    const BATTLE_ENTITY_TARGETS = [
        self::BATTLE_ENTITY_TARGET_GROUND,
        self::BATTLE_ENTITY_TARGET_GROUND_AIR,
        self::BATTLE_ENTITY_TARGET_BUILDINGS,
    ];


    /**
     * Array of troops of the game
     */
    const TROOPS_LIST = [
        'Giant', 'Bomber', 'Archers', 'Knight', 'Mini Pekka', 'Musketeer', 'Prince', 'Baby Dragon',
        'Skeleton Army', 'Witch', 'Spear Goblins', 'Goblins', 'Valkyrie', 'Skeletons', 'Minions',
        'Giant Skeleton', 'Balloon', 'Barbarians', 'Minion Horde', 'Hog Rider', 'Pekka', 'Wizard',
        'Golem'
    ];
}
