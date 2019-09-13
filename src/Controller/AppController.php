<?php

namespace Rest\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{

    /**
     * Token
     *
     * @var string
     */
    public $token = '';

    /**
     * Payload data decoded from token
     *
     * @var mixed
     */
    public $payload = [];

    /**
     * Initialization hook method.
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        $authorization = $this->getRequest()->getAttribute('authorization');

        // set token
        $this->token = $authorization['token'];

        // set payload
        $this->payload = $authorization['payload'];

        parent::initialize();
    }
}
