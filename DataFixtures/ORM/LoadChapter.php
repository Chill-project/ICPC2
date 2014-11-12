<?php

/*
 * Chill is a software for social workers 
 *
 * Copyright (C) 2014, Champs Libres Cooperative SCRLFS, <http://www.champs-libres.coop>
 * 
 * This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 *  License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Chill\ICPC2Bundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Chill\ICPC2Bundle\Entity\Chapter;

/**
 * Load Chapter into database
 */
class LoadChapter extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 17001;
    }
    
    public function load(ObjectManager $manager)
    {
        echo "loading Chapters...\n";

        $chapters =  [
        array("en" => "Process codes", "slug" => "-"),
        array("en" => "General and Unspecified", "slug" => "A"),
        array("en" => "Blood, Blood Forming, Organs and Immune Mechanism", "slug" => "B"),
        array("en" => "Digestive", "slug" => "D"),
        array("en" => "Eye", "slug" => "F"),
        array("en" => "Ear", "slug" => "H"),
        array("en" => "Cardiovascular", "slug" => "K"),
        array("en" => "Musculoskeletal", "slug" => "K"),
        array("en" => "Neurological", "slug" => "N"),
        array("en" => "Psychological", "slug" => "P"),
        array("en" => "Respiratory", "slug" => "R"),
        array("en" => "Skin", "slug" => "S"),
        array("en" => "Endocrine/Metabolic and Nutritional", "slug" => "T"),
        array("en" => "Urological", "slug" => "U"),
        array("en" => "Pregnancy, Childbearing, Family Planning", "slug" => "W"),
        array("en" => "Female Genital", "slug" => "X"),
        array("en" => "Male Genital", "slug" => "Y"),
        array("en" => "Social Problems", "slug" => "Z")
        ]

        foreach ($chapters as $c) {
            $e = (new Chapter())
                ->setSlug($c["slug"])
                ->setName(array("en" => $c["en"]));

            $this->addReference($c["slug"], $e);

            $manager->persist($e);
        }

        $manager->flush();
    }
}