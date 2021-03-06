<?php

namespace DogeDev\SwiftDil;

use DogeDev\SwiftDil\Traits\Client;

class Customer
{
    use Client;

    protected $url;
    protected $token;

    public function __construct($url, $token)
    {
        $this->url    = $url;
        $this->token  = $token;
    }

    /**
     * Lists all existing customers. The customers are returned sorted by
     * creation date, with the most recent customers appearing first.
     *
     * @return mixed
     */
    public function getAll()
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     *  Retrieves the details of an existing customer.
     * You need only supply the unique customer identifier that was returned upon customer creation.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function get($clientId)
    {
        try {
            $response = $this->getClient()->request('GET', $this->url . "/customers/$clientId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     *  Creates a new customer object.
     *
     * @param $data
     *
     * @return mixed
     */
    public function create($data)
    {
        try {
            $response = $this->getClient()->request('POST', $this->url . '/customers', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => $data,
            ]);

        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Updates the details of an existing customer
     * Please note, the customer type will not be editable once set.
     * Additionally, certain fields will not be editable once the customer has undergone a check.
     *
     * @param $clientId
     * @param $data
     *
     * @return mixed
     */
    public function update($clientId, $data)
    {
        try {
            $response = $this->getClient()->request('PUT', $this->url . "/customers/$clientId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Content-Type'  => 'application/json',
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }

    /**
     * Deletes an existing customer. You need only supply the unique customer identifier that was returned upon
     * customer creation. Also deletes any documents and notes on the customer. Please note, once a customer
     * has undergone any type of checks (e.g. screening), they can no longer be deleted.
     *
     * @param $clientId
     *
     * @return mixed
     */
    public function delete($clientId)
    {
        try {
            $response = $this->getClient()->request('DELETE', $this->url . "/customers/$clientId", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);
        } catch (\Exception $e) {
            $response = $e;
        }

        return json_decode($response->getBody()->getContents());
    }
}