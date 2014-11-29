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
use Chill\MainBundle\Templating\TranslatableStringHelper;

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
    private $om;
    
    /**
     *
     * @var TranslatableStringHelper 
     */
    private $translatableStringHelper;

    public function __construct(EntityManagerInterface $om, RequestStack $requestStack, 
        $defaultLocale, TwigEngine $templating, TranslatableStringHelper $translatableStringHelper)
    {
        $this->om = $om;
        $this->requestStack = $requestStack;
        $this->defaultLocale = $defaultLocale;
        $this->templating = $templating;
        $this->translatableStringHelper = $translatableStringHelper;
    }

    public function buildForm(FormBuilderInterface $builder, CustomField $customField)
    {
        $ICPC2Chapters =  $this->om->getRepository('ChillICPC2Bundle:Chapter')
            ->findAll();
            //->findBy(array(array(), 'id' => 'ASC'));

        $codesChoice = array();

        $locale = $this->requestStack->getCurrentRequest()->getLocale();

        foreach  ($ICPC2Chapters as $chap) {
            $chap_locale = $chap->getNameByLocale($locale, $this->defaultLocale).' ('.$chap->getSlug().')';
            $codesChoice[$chap_locale] = array();

            foreach ($chap->getCodes() as $c) {
                $codesChoice[$chap_locale][$c->getCode()] = $c->getCode().' - '.$c->getNameByLocale($locale,$this->defaultLocale);
            }
        }

        $builder->add($customField->getSlug(), 'select2_choice', array(
            'choices' => $codesChoice,
            'empty_value' => 'Choose icpc code',
            'required' => false,
            'label' => $this->translatableStringHelper->localize($customField->getName())
        ));
    }

    public function getName()
    {
        return 'CF ICPC2';
    }

    public function render($value, CustomField $customField)
    {
        $code = $this->deserialize($value, $customField);
        
        if (NULL === $code) {
            return '';
        }
        
        return $this->templating->render("ChillICPC2Bundle:CustomFieldsRendering:"
              . "icpc2.html.twig", array(
                 'icpc' => $code
              ));
    }

    public function buildOptionsForm(FormBuilderInterface $builder)
    {
        return $builder;
    }

    public function deserialize($serialized, CustomField $customField)
    {
        return $this->om->getRepository('ChillICPC2Bundle:Code')
            ->findOneBy(array('code' => $serialized));
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
