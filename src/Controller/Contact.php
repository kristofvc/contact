<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Contact\Controller;

use Kristofvc\Contact\Event\ContactEvent;
use Kristofvc\Contact\Event\ContactEvents;
use Kristofvc\Contact\Form\Type\ContactTypeInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class Contact
 * @package Kristofvc\Contact\Controller\Main
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
     * @param EngineInterface $templating
     * @param FormFactoryInterface $formFactory
     * @param EventDispatcherInterface $eventDispatcher
     * @param ContactTypeInterface $contactType
     * @param $template
     */
    public function __construct(
        EngineInterface $templating,
        FormFactoryInterface $formFactory,
        EventDispatcherInterface $eventDispatcher,
        ContactTypeInterface $contactType,
        $template
    ) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->eventDispatcher = $eventDispatcher;
        $this->contactType = $contactType;
        $this->template = $template;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $form = $this->formFactory->createBuilder($this->contactType);
        $form->setAction($request->getBasePath());
        $form = $form->getForm();

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $event = ContactEvent::createWith($form->getData());
                $this->eventDispatcher->dispatch(ContactEvents::CONTACT_SUBMITTED_EVENT, $event);

                $form = $this->formFactory->create($this->contactType);
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
