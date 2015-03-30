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

use Kristofvc\Contact\Form\Handler\ContactFormHandlerInterface;
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
     * @var string
     */
    private $template;

    /**
     * @var ContactFormHandlerInterface
     */
    private $formHandler;

    /**
     * @param EngineInterface $templating
     * @param ContactFormHandlerInterface $formHandler
     * @param $template
     */
    public function __construct(
        EngineInterface $templating,
        ContactFormHandlerInterface $formHandler,
        $template
    ) {
        $this->templating = $templating;
        $this->formHandler = $formHandler;
        $this->template = $template;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $form = $this->formHandler->getForm($request->getBasePath());

        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);
            if ($this->formHandler->handleForm($form)) {
                $form = $this->formHandler->getForm($request->getBasePath());
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
