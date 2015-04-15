<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace Kristofvc\Component\Contact\Http;

/**
 * Interface ClientInterface
 * @package Kristofvc\Component\Contact\Http
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
interface ClientInterface
{
    /**
     * Create a post request
     * that can be send through the send method
     *
     * @param $webHook
     * @param array $data
     *
     * @return mixed
     */
    public function createPostRequest($webHook, array $data);

    /**
     * Effectively send the request
     *
     * @param $request
     */
    public function send($request);
}
