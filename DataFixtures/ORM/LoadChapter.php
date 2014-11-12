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
        array("en" => "Process codes", "fr" => "Procédures", "slug" => "-"),
        array("en" => "General and Unspecified", "fr" => "Général et non spécifié",  "slug" => "A"),
        array("en" => "Blood, Blood Forming, Organs and Immune Mechanism", "fr" => "Sang, syst. hématop/ immunol.",  "slug" => "B"),
        array("en" => "Digestive", "fr" => "Syst. Digestif",  "slug" => "D"),
        array("en" => "Eye", "fr" => "Oeil",  "slug" => "F"),
        array("en" => "Ear", "fr" => "Oreille",  "slug" => "H"),
        array("en" => "Cardiovascular", "fr" => "Cardio-vasculaire",  "slug" => "K"),
        array("en" => "Musculoskeletal", "fr" => "Ostéo-articulaire",  "slug" => "L"),
        array("en" => "Neurological", "fr" => "Neurologique",  "slug" => "N"),
        array("en" => "Psychological", "fr" => "Psychologique",  "slug" => "P"),
        array("en" => "Respiratory", "fr" => "Respiratoire",  "slug" => "R"),
        array("en" => "Skin", "fr" => "Peau",  "slug" => "S"),
        array("en" => "Endocrine/Metabolic and Nutritional", "fr" => "Métabol., nutrit., endocrinien",  "slug" => "T"),
        array("en" => "Urological", "fr" => "Système Urinaire",  "slug" => "U"),
        array("en" => "Pregnancy, Childbearing, Family Planning", "fr" => "Grossesse, accouchement et PF",  "slug" => "W"),
        array("en" => "Female Genital", "fr" => "Syst.génital féminin et sein",  "slug" => "X"),
        array("en" => "Male Genital", "fr" => "Syst. génital masculin et sein",  "slug" => "Y"),
        array("en" => "Social Problems", "fr" => "Social",  "slug" => "Z")
        ];

        foreach ($chapters as $c) {
            echo($c["en"]."\n");
            $e = (new Chapter())
                ->setSlug($c["slug"])
                ->setName(array("en" => $c["en"], "fr" => $c["fr"]));

            $this->addReference($c["slug"], $e);

            $manager->persist($e);
        }

        $manager->flush();
    }
}