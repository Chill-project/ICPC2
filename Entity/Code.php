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

/**
 * Code
 */
class Code
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \stdClass
     */
    private $chapter;

    /**
     * @var \stdClass
     */
    private $component;

    /**
     * @var array
     */
    private $name;


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
     * Set code
     *
     * @param string $code
     *
     * @return Code
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set chapter
     *
     * @param \stdClass $chapter
     *
     * @return Code
     */
    public function setChapter($chapter)
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * Get chapter
     *
     * @return \stdClass
     */
    public function getChapter()
    {
        return $this->chapter;
    }

    /**
     * Set component
     *
     * @param \stdClass $component
     *
     * @return Code
     */
    public function setComponent($component)
    {
        $this->component = $component;

        return $this;
    }

    /**
     * Get component
     *
     * @return \stdClass
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Set name
     *
     * @param array $name
     *
     * @return Code
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
     * Get name
     *
     * @return array
     */
    public function getNameByLocale($lang, $defaultLang)
    {
        if(array_key_exists($lang, $this->name)) {
            return $this->name[$lang];
        } else {
            return $this->name[$defaultLang];
        }
    }
}

