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

namespace Chill\ICPC2Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Chapter
 */
class Chapter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var array
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    private $codes;  

    public function __construct()
    {
        $this->codes = new ArrayCollection();
    }  


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param array $name
     *
     * @return Chapter
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return array
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get name by locale
     *
     * @return string
     */
    public function getNameByLocale($lang, $defaultLang)
    {
        if(array_key_exists($lang, $this->name)) {
            return $this->name[$lang];
        } else {
            return $this->name[$defaultLang];
        }
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Chapter
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get codes
     *
     * @return string
     */
    public function getCodes()
    {
        return $this->codes;
    }

}

