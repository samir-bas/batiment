<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) {
            $project = new Project();
            $project->setUser($this->getReference('Hopper'));
            $project->setName('Projet N°'.$i);
            $project->setDescription('Description N°'.$i);
            $project->setBeginDate(new DateTime());
            $project->setEndDate(new DateTime());
            $this->addReference("Proj".$i, $project);
            $manager->persist($project);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
