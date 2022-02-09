<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Actor;
use App\Service\Slugify;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        [
            'name' => 'Norman Reedus',
        ],
        [
            'name' => 'Andrew Lincoln',
        ],
        [
            'name' => 'Lauren Cohan',
        ],
        [
            'name' => 'Maggie Reedus',
        ],
        [
            'name' => 'Paul Reedus',
        ]
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTORS as $key => $actorData) {
            $actor = new Actor();
            $actor->setName($actorData['name']);

            $actor->setSlug($this->slugify->generate($actor->getName()));

            $manager->persist($actor);

            $this->addReference('actor_' . $key, $actor);
        }

        $manager->flush();
    }
}