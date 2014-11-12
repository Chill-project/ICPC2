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
use Chill\ICPC2Bundle\Entity\Component;

/**
 * Load Component for Report into database
 */
class LoadComponent extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 17002;
    }
    
    public function load(ObjectManager $manager)
    {
        echo "loading Components...\n";

        $components =  [
        array("en" => "PROCESS CODES", "slug" => "pro"),
        array("en" => "SYMPTOMS/COMPLAINTS", "slug" => "sym"),
        array("en" => "INFECTIONS", "slug" => "inf"),
        array("en" => "NEOPLASMS", "slug" => "neo"),
        array("en" => "INJURIES", "slug" => "inj"),
        array("en" => "CONGENITAL ANOMALIES", "slug" => "con"),
        array("en" => "OTHER DIAGNOSES", "slug" => "oth"),
        ];

        foreach ($components as $c) {
            echo($c["en"]."\n");
            $e = (new Component())
                ->setSlug($c["slug"])
                ->setName(array("en" => $c["en"]));

            $this->addReference($c["slug"], $e);

            $manager->persist($e);
        }

        $manager->flush();
    }
}