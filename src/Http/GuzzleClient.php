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

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Stream\Stream;
use Kristofvc\Component\Contact\Http\ClientInterface as BaseClient;

/**
 * Class GuzzleClient
 * @package Kristofvc\Component\Contact\Http
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 */
final class GuzzleClient implements BaseClient
{
    /**
     * @var GuzzleClientInterface
     */
    private $client;

    /**
     * @param GuzzleClientInterface $client
     */
    public function __construct(GuzzleClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function createPostRequest($webHook, array $data)
    {
        $stream = Stream::factory(json_encode($data));

        $request = $this->client->createRequest('POST', $webHook);
        $request->setBody($stream);

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function send($request)
    {
        $this->client->send($request);
    }
}
