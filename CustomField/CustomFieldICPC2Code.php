<?php

/*
 *  Chill is a software for social workers
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

namespace Chill\ICPC2Bundle\CustomField;

use Symfony\Component\Form\FormBuilderInterface;
use Chill\CustomFieldsBundle\Entity\CustomField;
use Chill\CustomFieldsBundle\CustomFields\CustomFieldInterface;
use Chill\ICPC2BundleBundle\Entity\Code;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bridge\Twig\TwigEngine;

/**
 * Todo
 */
class CustomFieldICPC2Code implements CustomFieldInterface
{
    /**
     * 
     * @var RequestStack
     */
    private $requestStack;
    
    private $defaultLocale;
    
    /**
     * 
     * @var TwigEngine
     */
    private $templating;

    /**
     *
     * @var EntityManagerInterface
     */
    public $om;

    public function __construct(EntityManagerInterface $om, RequestStack $requestStack, 
        $defaultLocale, TwigEngine $templating)
    {
        $this->om = $om;
        $this->requestStack = $requestStack;
        $this->defaultLocale = $defaultLocale;
        $this->templating = $templating;
    }

    public function buildForm(FormBuilderInterface $builder, CustomField $customField)
    {
        $ICPC2Chapters =  $this->om->getRepository('ChillICPC2Bundle:Chapter')
            ->findAll();
            //->findBy(array(array(), 'id' => 'ASC'));

        $codesChoice = array();

        $locale = $this->requestStack->getCurrentRequest()->getLocale();

        foreach  ($ICPC2Chapters as $chap) {
            $chap_locale = $chap->getNameByLocale($locale, $this->defaultLocale);
            $codesChoice[$chap_locale] = array();

            foreach ($chap->getCodes() as $c) {
                $codesChoice[$chap_locale][$c->getCode()] = $c->getNameByLocale($locale,$this->defaultLocale);
            }
        }

        $builder->add($customField->getSlug(), 'choice', array(
            'choices' => $codesChoice,
            'empty_value' => 'Choisissez le code CISP'
        ));
    }

    public function getName()
    {
        return 'CF ICPC2';
    }

    public function render($value, CustomField $customField)
    {
        
    }

    public function buildOptionsForm(FormBuilderInterface $builder)
    {
        return $builder;
    }

    public function deserialize($serialized, CustomField $customField)
    {
        return $this->om->getRepository('ChillICPC2Bundle:Code')
            ->findByCode($serialized);
    }

    /**
     * 
     * @param \Chill\CustomFieldsBundle\Entity\Adress $value
     * @param CustomField $customField
     * @return type
     */
    public function serialize($value, CustomField $customField)
    {
        return $value->getCode();
    }

}