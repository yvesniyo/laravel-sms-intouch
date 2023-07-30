<?php

namespace Yvesniyo\SmsIntouchLaravel;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Config;
use Yvesniyo\SmsIntouchLaravel\Dto\SmsResult;

class Sms
{

    /**
     * 
     * @param \Yvesniyo\SmsIntouchLaravel\Dto\SmsDto[] $messages
     */
    public function sendMessage(
        array $messages,
        string $callbackUrl = "",
        string $sender = null,
        int $concurency = 25
    ) {

        $url = "www.intouchsms.co.rw/api/sendsms/.json";

        $sender = is_null($sender) ? Config::get("sms-intouch.sender", null) : $sender;
        if (is_null($sender) || empty($sender)) {

            throw new Exception("Invalid sender");
        }

        $username = Config::get("sms-intouch.username", null);
        $password = Config::get("sms-intouch.password", null);

        $headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
        ];

        $requests = [];
        foreach ($messages as $key => $message) {

            $body = json_encode([
                "sender" => $sender,
                "message" => $message->getMessage(),
                "recipients" => $message->getReciepient(),
                "dlrurl" => $callbackUrl,
            ]);
            $requests[$key] = new Request("POST", $url, $headers, $body);
        }


        /** @var SmsResult[] */
        $results = [];

        $pool = new Pool(new Client(), $requests, [
            "concurency" => $concurency,
            "fulfilled" => function ($response, $index) use (&$results) {

                $json = json_decode($response->getBody(), true);

                $results[$index] = (new SmsResult())
                    ->setCost($json["cost"])
                    ->setStatus($json["status"])
                    ->setMessageid($json["messageid"])
                    ->setMessage($json["message"]);
            },
            "rejected" => function ($reason, $index) use (&$results) {

                $results[$index] = (new SmsResult())
                    ->setIsOk(false)
                    ->setReason($reason->getMessage());
            },
            'auth' => [$username, $password, "digest"],
        ]);


        // Initiate the transfers and create a promise
        $promise = $pool->promise();
        // Force the pool of requests to complete.
        $promise->wait();


        return $results;
    }
}
