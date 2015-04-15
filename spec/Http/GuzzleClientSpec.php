<?php

/*
 * This file is part of the kristofvc/contact component.
 *
 * (c) Kristof Van Cauwenbergh
 *
 * For the full copyright and license information, please view the meta/LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kristofvc\Component\Contact\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Stream\Stream;
use GuzzleHttp\Stream\StreamInterface;
use Kristofvc\Component\Contact\Http\GuzzleClient;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class GuzzleClientSpec
 * @package spec\Kristofvc\Component\Contact\Http
 *
 * @author Kristof Van Cauwenbergh <kristof.vancauwenbergh@gmail.com>
 *
 * @mixin GuzzleClient
 */
class GuzzleClientSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kristofvc\Component\Contact\Http\GuzzleClient');
    }

    function it_should_implement_client_interface()
    {
        $this->shouldImplement('Kristofvc\Component\Contact\Http\ClientInterface');
    }

    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_can_send_request(ClientInterface $client, RequestInterface $request)
    {
        $client->send($request)->shouldBeCalled();
        $this->send($request);
    }

    function it_can_create_request(ClientInterface $client, RequestInterface $request)
    {
        $webHook = 'http://incoming-webhook-url';
        $data = [
            'text' => 'Cool website Bro!',
            'channel' => '#general',
            'username' => 'Kristof (kristof@kristofvc.be)',
            'icon_emoji' => ':envelope:'
        ];

        $client->createRequest('POST', $webHook)->shouldBeCalled()->willReturn($request);
        $request->setBody(Argument::type('GuzzleHttp\Stream\Stream'))->shouldBeCalled();

        $this->createPostRequest($webHook, $data)->shouldReturn($request);
    }
}
