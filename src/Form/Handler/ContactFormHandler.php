<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Contact\Form\Handler;

use Kristofvc\Contact\Event\ContactEvent;
use Kristofvc\Contact\Event\ContactEvents;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Kristofvc\Contact\Form\Type\ContactTypeInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class ContactFormHandler
 * @package Kristofvc\Contact\Form\Handler
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
class ContactFormHandler implements ContactFormHandlerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var ContactTypeInterface
     */
    private $contactType;

    /**
     * @param FormFactoryInterface $formFactory
     * @param EventDispatcherInterface $eventDispatcher
     * @param ContactTypeInterface $contactType
     */
    public function __construct(FormFactoryInterface $formFactory, EventDispatcherInterface $eventDispatcher, ContactTypeInterface $contactType)
    {
        $this->formFactory = $formFactory;
        $this->eventDispatcher = $eventDispatcher;
        $this->contactType = $contactType;
    }

    /**
     * {@inheritdoc}
     */
    public function getForm($basePath)
    {
        $form = $this->formFactory->createBuilder($this->contactType);
        $form->setAction($basePath);
        return $form->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function handleForm(FormInterface $form)
    {
        $event = ContactEvent::createWith($form->getData());
        if ($form->isValid()) {
            $this->eventDispatcher->dispatch(ContactEvents::CONTACT_SUBMIT_SUCCESS_EVENT, $event);
            return true;
        } else {
            $this->eventDispatcher->dispatch(ContactEvents::CONTACT_SUBMIT_FAILURE_EVENT, $event);
            return false;
        }
    }
}
