<?php

namespace Wallabag\AnnotationBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Wallabag\AnnotationBundle\Entity\Annotation;
use Wallabag\CoreBundle\DataFixtures\EntryFixtures;
use Wallabag\CoreBundle\Entity\Entry;
use Wallabag\UserBundle\DataFixtures\UserFixtures;
use Wallabag\UserBundle\Entity\User;

class AnnotationFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $annotation1 = new Annotation($this->getReference('admin-user', User::class));
        $annotation1->setEntry($this->getReference('entry1', Entry::class));
        $annotation1->setText('This is my annotation /o/');
        $annotation1->setQuote('content');

        $manager->persist($annotation1);

        $this->addReference('annotation1', $annotation1);

        $annotation2 = new Annotation($this->getReference('admin-user', User::class));
        $annotation2->setEntry($this->getReference('entry2', Entry::class));
        $annotation2->setText('This is my 2nd annotation /o/');
        $annotation2->setQuote('content');

        $manager->persist($annotation2);

        $this->addReference('annotation2', $annotation2);

        $annotation3 = new Annotation($this->getReference('bob-user', User::class));
        $annotation3->setEntry($this->getReference('entry3', Entry::class));
        $annotation3->setText('This is my first annotation !');
        $annotation3->setQuote('content');

        $manager->persist($annotation3);

        $this->addReference('annotation3', $annotation3);

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            EntryFixtures::class,
            UserFixtures::class,
        ];
    }
}