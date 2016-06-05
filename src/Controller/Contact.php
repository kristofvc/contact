<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Controller;

use Kristofvc\Component\Contact\Event\ContactEvent;
use Kristofvc\Component\Contact\Event\ContactEvents;
use Kristofvc\Component\Contact\Form\Type\ContactTypeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class Contact
 * @package Kristofvc\Component\Contact\Controller\Main
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class Contact
{
    /**
     * @var EngineInterface
     */
    private $templating;

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
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $submitPath;

    /**
     * @param EngineInterface $templating
     * @param FormFactoryInterface $formFactory
     * @param EventDispatcherInterface $eventDispatcher
     * @param ContactTypeInterface $contactType
     * @param $template
     * @param null $submitPath
     */
    public function __construct(
        EngineInterface $templating,
        FormFactoryInterface $formFactory,
        EventDispatcherInterface $eventDispatcher,
        $contactType,
        $template,
        $submitPath = null
    ) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->eventDispatcher = $eventDispatcher;
        $this->contactType = $contactType;
        $this->template = $template;
        $this->submitPath = $submitPath;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $form = $this->formFactory->createBuilder($this->contactType);

        if ($this->submitPath !== null) {
            $form->setAction($this->submitPath);
        } else {
            $form->setAction($request->getUri());
        }

        $form = $form->getForm();

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            $event = ContactEvent::createWith($form->getData());
            if ($form->isValid()) {
                $this->eventDispatcher->dispatch(ContactEvents::CONTACT_SUBMIT_SUCCESS_EVENT, $event);

                $form = $this->formFactory->create($this->contactType);
            } else {
                $this->eventDispatcher->dispatch(ContactEvents::CONTACT_SUBMIT_FAILURE_EVENT, $event);
            }
        }

        return new Response(
            $this->templating->render(
                $this->template,
                [
                    'form' => $form->createView()
                ]
            )
        );
    }
}
