<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Task;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) {
            $task = new Task();
            $task->setProject($this->getReference('Proj'. $i));
            $task->setName('Tâche N°'.$i);
            $task->setDescription('Description N°'.$i);
            $task->setBeginDate(new DateTime());
            $task->setEndDate(new DateTime());
            $manager->persist($task);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProjectFixtures::class,
        ];
    }
}
