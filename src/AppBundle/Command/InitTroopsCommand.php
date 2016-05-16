<?php

namespace AppBundle\Command;

use AppBundle\Entity\Troop;
use CoreBundle\Constants;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * A command console that creates the troops and stores them in the database.
 * To use this command, open a terminal window, enter into your project
 * directory and execute the following:.
 *
 *     $ php bin/console app:init-troops
 */
class InitTroopsCommand extends ContainerAwareCommand
{
    /**
     * @var string
     */
    const COMMAND_NAME = 'app:init-troops';

    /**
     * Add the configuration options to display on the command line
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('Command to create the base of database troops to be able to calculate the efficiency');
    }

    /**
     * Execute the command line script
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $troopsList = Constants::TROOPS_LIST;

        foreach ($troopsList as $troopName) {
            $troop = new Troop;
            $troop
                ->setName($troopName)
                ->setBattleEntityType(Constants::BATTLE_ENTITY_TYPE_TROOP)
                ->setHitPoints(1)
                ->setDps(1)
                ->setSpeed(Constants::BATTLE_ENTITY_MOVEMENT_SLOW)
                ->setTarget(Constants::BATTLE_ENTITY_TARGET_GROUND)
                ->setRange(0)
                ->setCost(1)
                ->setDeploy(1)
                ->setUnits(1);

            $em->persist($troop);
        }

        $em->flush();

        return;
    }
}
