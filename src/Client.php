<?php

namespace Ourvoice;

use Ourvoice\Common\HttpClient;

/**
 * Class Client
 *
 * @package Ourvoice\Sdk
 */
class Client
{
    public const ENDPOINT = 'https://staging.getourvoice.com/api/v1';
    
    const CLIENT_VERSION = '3.1.2';

    /**
     * @var Resources\Contacts
     */
    public $contacts;
    /**
     * @var Resources\Groups
     */
    public $groups;
     /**
     * @var Resources\Account
     */
    public $account;

    /**
     * @var Resources\Roles
     */
    public $roles;

    /**
     * @var Resources\Edges
     */
    public $edges;
    
    /**
     * @var Resources\FlowExecutions
     */
    public $flowExecutions;

    /**
     * @var Resources\Flows
     */
    public $flows;

    /**
     * @var Resources\ApiKeys
     */
    public $apikeys;
    
    /**
     * @var Resources\Campaigns
     */
    public $campaigns;

    /**
     * @var Resources\Invitations
     */
    public $invitations;

    /**
     * @var Resources\Medias
     */
    public $medias;

    /**
     * @var Resources\Messages
     */
    public $messages;


      /**
     * @var Resources\Users
     */
    public $users;

    /**
     * @var Resources\Transactions
     */
    public $transactions;

    /**
     * @var Resources\Webhooks
     */
    public $webhooks;

    /**
     * @var Resources\NumberRequests
     */
    public $numberRequests;

    /**
     * @var Resources\Numbers
     */
    public $numbers;

    /**
     * @var Resources\Plans
     */
    public $plans;

    /**
     * @var Resources\Senders
     */
    public $senders;

    /**
     * @var Resources\Steps
     */
    public $steps;

    /**
     * @var Resources\Subscriptions
     */
    public $subscriptions;

    /**
     * @var Resources\Voices
     */
    public $voices;
    
    protected $endpoint = self::ENDPOINT;
    /**
     * @var Common\HttpClient
     */
    protected $httpClient;

    

    public function __construct(?string $accessKey = null, Common\HttpClient $httpClient = null, array $config = [])
    {
        if ($httpClient === null) {
           
            $this->httpClient = new Common\HttpClient(self::ENDPOINT);
            
        } else {
            
            $this->httpClient = $httpClient;
           
        }

        $this->httpClient->addUserAgentString('Ourvoice/ApiClient/' . self::CLIENT_VERSION);
        $this->httpClient->addUserAgentString($this->getPhpVersion());

        if ($accessKey !== null) {
            $this->setAccessKey($accessKey);
        }
        $this->account = new Resources\Account($this->httpClient);
        $this->apikeys = new Resources\ApiKeys($this->httpClient);
        $this->campaigns = new Resources\Campaigns($this->httpClient);
        $this->contacts = new Resources\Contacts($this->httpClient);
        $this->edges = new Resources\Edges($this->httpClient);
        $this->flowExecutions = new Resources\FlowExecutions($this->httpClient);
        $this->groups = new Resources\Groups($this->httpClient);
        $this->invitations = new Resources\Invitations($this->httpClient);
        $this->medias = new Resources\Medias($this->httpClient);
        $this->messages = new Resources\Messages($this->httpClient);
        $this->numberRequests = new Resources\NumberRequests($this->httpClient);
        $this->numbers = new Resources\Numbers($this->httpClient);
        $this->plans = new Resources\Plans($this->httpClient);
        $this->roles = new Resources\Roles($this->httpClient);
        $this->senders = new Resources\Senders($this->httpClient);
        $this->steps = new Resources\Steps($this->httpClient);
        $this->subscriptions = new Resources\Subscriptions($this->httpClient);
        $this->transactions = new Resources\Transactions($this->httpClient);
        $this->users = new Resources\Users($this->httpClient);
        $this->voices = new Resources\Voices($this->httpClient);
        $this->webhooks = new Resources\Webhooks($this->httpClient);
    }

    private function getPhpVersion(): string
    {
        if (!\defined('PHP_VERSION_ID')) {
            $version = array_map('intval', explode('.', \PHP_VERSION));
            \define('PHP_VERSION_ID', $version[0] * 10000 + $version[1] * 100 + $version[2]);
        }

        return 'PHP/' . \PHP_VERSION_ID;
    }

    /**
     * @param mixed $accessKey
     */
    public function setAccessKey($accessKey): void
    {
        $authentication = new Common\Authentication($accessKey);
        $this->httpClient->setAuthentication($authentication);
    }
}
