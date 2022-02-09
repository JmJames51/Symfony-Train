<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const SHOW = [
        [
            'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/21/11/02/11/12/2878509.jpg',
            'title' => 'Arcane',
            'synopsis' => 'Championnes de leurs villes jumelles et rivales (la huppée Piltover et la sous-terraine Zaun), deux sœurs Vi et Powder se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.',
            'country' => 'USA',
            'year' => 2022,
            'categorieReference' => 'category_1'

        ],

        [
            'poster' => 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/06/18/12/11/3956503.jpg',
            'title' => 'Breaking Bad',
            'synopsis' => 'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. Son quotidien déjà morose devient carrément noir lorsqu\'il apprend qu\'il est atteint d\'un incurable cancer des poumons. Les médecins ne lui donnent pas plus de deux ans à vivre. Pour réunir rapidement beaucoup d\'argent afin de mettre sa famille à l\'abri, Walter ne voit plus qu\'une solution : mettre ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth, une drogue de synthèse qui rapporte beaucoup. Il propose à Jesse, un de ses anciens élèves devenu un petit dealer de seconde zone, de faire équipe avec lui. Le duo improvisé met en place un labo itinérant dans un vieux camping-car. Cette association inattendue va les entraîner dans une série de péripéties tant comiques que pathétiques.',
            'country' => 'USA',
            'year' => 2022,
            'categorieReference' => 'category_2'

        ],

        [
            'poster' => 'https://fr.web.img2.acsta.net/c_310_420/pictures/21/02/01/16/54/3730739.jpg',
            'title' => 'WandaVision',
            'synopsis' => 'WandaVision combine des éléments de sitcom traditionnelle à ceux de l’Univers Cinématographique Marvel. Wanda Maximoff alias Scarlet Witch et Vision sont des super-héros, vivant dans une banlieue idéalisée mais commençant à soupçonner que tout n’est peut-être pas ce qu\'il paraît être...',
            'country' => 'USA',
            'year' => 2022,
            'categorieReference' => 'category_3'

        ],

        [
            'poster' => 'https://fr.web.img5.acsta.net/c_310_420/pictures/19/12/12/12/13/2421997.jpg',
            'title' => 'The Witcher',
            'synopsis' => 'Adaptation Live de la saga littéraire du Sorceleur.
            Le sorceleur Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.',
            'country' => 'USA',
            'year' => 2022,
            'categorieReference' => 'category_4'
        ],
    ];

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::SHOW as $key => $showData) {
            $show = new Program();
            $show->setPoster($showData['poster']);
            $show->setTitle($showData['title']);
            $show->setSynopsis($showData['synopsis']);
            $show->setCountry($showData['country']);
            $show->setYear($showData['year']);
            for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
                $show->addActor($this->getReference('actor_' . $i));
            }
            $show->setSlug($this->slugify->generate($show->getTitle()));

            $show->setCategory($this->getReference($showData['categorieReference']));

            $manager->persist($show);
            $this->addReference('program_' . $key, $show);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}
