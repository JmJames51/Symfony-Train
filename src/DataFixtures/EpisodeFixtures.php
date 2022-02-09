<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use App\Service\Slugify;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => '1',
            'number' => 1,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '2',
            'number' => 2,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '3',
            'number' => 3,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '4',
            'number' => 4,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '5',
            'number' => 5,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '6',
            'number' => 6,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '7',
            'number' => 7,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '8',
            'number' => 8,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '9',
            'number' => 9,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '10',
            'number' => 10,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '11',
            'number' => 11,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '12',
            'number' => 12,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '13',
            'number' => 13,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_0'
        ],

        [
            'title' => '1',
            'number' => 1,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '2',
            'number' => 2,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '3',
            'number' => 3,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '4',
            'number' => 4,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '5',
            'number' => 5,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '6',
            'number' => 6,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '7',
            'number' => 7,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '8',
            'number' => 8,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '9',
            'number' => 9,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '10',
            'number' => 10,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '11',
            'number' => 11,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '12',
            'number' => 12,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ],

        [
            'title' => '13',
            'number' => 13,
            'synopsis' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora, blanditiis sint. Odio, eveniet quisquam debitis asperiores deserunt a facere quo, optio accusantium adipisci officia officiis aliquam similique eligendi voluptas quas!',
            'seasonReference' => 'season_1'
        ]

    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES as $key => $episodeData) {
            $episode = new Episode();
            $episode->setTitle($episodeData['title']);
            $episode->setNumber($episodeData['number']);
            $episode->setSynopsis($episodeData['synopsis']);

            $episode->setSeason($this->getReference($episodeData['seasonReference']));
            $episode->setSlug($this->slugify->generate($episodeData['title']));

            $manager->persist($episode);

            $this->addReference('episode_' . $key, $episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class
        ];
    }
}
