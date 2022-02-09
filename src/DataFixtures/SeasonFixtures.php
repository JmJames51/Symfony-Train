<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Season;
use App\DataFixtures\ProgramFixtures;
use App\Service\Slugify;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        [
            'number' => 1,
            'year' => '2019',
            'description' => 'Saison 1',
            'program' => 'program_0'
        ],
        [
            'number' => 2,
            'year' => '2019',
            'description' => 'Saison 2',
            'program' => 'program_0'
        ],
        [
            'number' => 3,
            'year' => '2019',
            'description' => 'Saison 3',
            'program' => 'program_0'
        ],
        [
            'number' => 4,
            'year' => '2019',
            'description' => 'Saison 4',
            'program' => 'program_0'
        ],
        [
            'number' => 1,
            'year' => '2019',
            'description' => 'Saison 1',
            'program' => 'program_1'
        ],
        [
            'number' => 2,
            'year' => '2019',
            'description' => 'Saison 2',
            'program' => 'program_1'
        ],
        [
            'number' => 3,
            'year' => '2019',
            'description' => 'Saison 3',
            'program' => 'program_1'
        ],
        [
            'number' => 4,
            'year' => '2019',
            'description' => 'Saison 4',
            'program' => 'program_1'
        ],
        [
            'number' => 1,
            'year' => '2019',
            'description' => 'Saison 1',
            'program' => 'program_2'
        ],
        [
            'number' => 2,
            'year' => '2019',
            'description' => 'Saison 2',
            'program' => 'program_2'
        ],
        [
            'number' => 3,
            'year' => '2019',
            'description' => 'Saison 3',
            'program' => 'program_2'
        ],
        [
            'number' => 4,
            'year' => '2019',
            'description' => 'Saison 4',
            'program' => 'program_2'
        ]
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $key => $seasonData) {
            $season = new Season();
            $season->setNumber($seasonData['number']);
            $season->setYear($seasonData['year']);
            $season->setDescription($seasonData['description']);
            $season->setProgram($this->getReference($seasonData['program']));
            $season->setSlug($this->slugify->generate($season->getNumber()));
            $manager->persist($season);
            $this->addReference('season_' . $key, $season);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class
        ];
    }
}