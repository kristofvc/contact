<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Model;

/**
 * Interface ContactInterface
 * @package Kristofvc\Component\Contact\Model
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
interface ContactInterface
{
    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getSubject();
}
