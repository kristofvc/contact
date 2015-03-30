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
use Symfony\Component\Form\FormInterface;

/**
 * Interface ContactFormHandlerInterface
 * @package Kristofvc\Contact\Form\Handler
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
interface ContactFormHandlerInterface
{
    /**
     * @param $basePath
     *
     * @return FormInterface
     */
    public function getForm($basePath);

    /**
     * @param FormInterface $form
     *
     * @return bool
     */
    public function handleForm(FormInterface $form);
}
