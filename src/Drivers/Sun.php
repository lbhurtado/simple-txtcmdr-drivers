<?php
/**
 * Created by PhpStorm.
 * User: lbhurtado
 * Date: 07/05/16
 * Time: 08:15
 */

namespace LBHurtado\SMS\Drivers;

use SimpleSoftwareIO\SMS\Drivers\AbstractSMS;
use SimpleSoftwareIO\SMS\Drivers\DriverInterface;
use SimpleSoftwareIO\SMS\IncomingMessage;
use SimpleSoftwareIO\SMS\OutgoingMessage;
use GuzzleHttp\Client;

class Sun
{
    private $client;

    private $from;

    private $session;

    /**
     * @param $user
     * @param $pass
     * @param $mask
     * @param string $login_url
     */
    public function __construct($user, $pass, $mask, $login_url = 'http://mcpro.sun-solutions.ph/emcpro/login.aspx')
    {
        $this->client = new Client();
        $this->from = $mask;

        $query = http_build_query(compact('user', 'pass'));
        $res = $this->client->request('GET', "$login_url?$query", []);
        if ($res->getStatusCode() == 200)
        {
            $body = $res->getBody()->getContents();
            $result = explode(',', $body);
            if ((int)$result[0] == 20100)
            {
                $this->session = $result[2];
            }
        }
    }

    /**
     * Sends a SMS message.
     *
     * @param \SimpleSoftwareIO\SMS\OutgoingMessage $message
     * @return OutgoingMessage $message
     */
    public function send(OutgoingMessage $message)
    {
        $session = $this->session;
        if ($session)
        {
            $from = $this->from;
            $msg = $message->composeMessage();
            foreach ($message->getTo() as $to)
            {
                $query = http_build_query(compact('session', 'from', 'to', 'msg'));
                $this->client->request('GET', "http://mcpro.sun-solutions.ph/emcpro/send.aspx?$query", []);
            }
        }

        return $message;
    }

    /**
     * Creates many IncomingMessage objects and sets all of the properties.
     *
     * @param $rawMessage
     * @return mixed
     */
    protected function processReceive($rawMessage)
    {
        throw new \RuntimeException('Smart Suite does not support Inbound API Calls.');
    }

    /**
     * Checks the server for messages and returns their results.
     *
     * @param array $options
     * @return array
     */
    public function checkMessages(Array $options = array())
    {
        throw new \RuntimeException('Smart Suite does not support Inbound API Calls.');
    }

    /**
     * Gets a single message by it's ID.
     *
     * @param $messageId
     * @return IncomingMessage
     */
    public function getMessage($messageId)
    {
        throw new \RuntimeException('Smart Suite does not support Inbound API Calls.');
    }

    /**
     * Receives an incoming message via REST call.
     *
     * @param $raw
     * @return \SimpleSoftwareIO\SMS\IncomingMessage
     */
    public function receive($raw)
    {
        throw new \RuntimeException('Smart Suite does not support Inbound API Calls.');
    }
}