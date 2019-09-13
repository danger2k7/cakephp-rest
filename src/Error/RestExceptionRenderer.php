<?php

namespace Rest\Error;

use Cake\Core\Configure;
use Cake\Error\Debugger;
use Cake\Error\ExceptionRenderer;
use Cake\Core\Exception as CakeException;
use Psr\Http\Message\ResponseInterface;
use Rest\Controller\ErrorController;

class RestExceptionRenderer extends ExceptionRenderer
{
    /**
     * Renders the response for the exception.
     *
     * @return \Cake\Http\Response The response to be sent.
     */
    public function render(): ResponseInterface
    {
        $exception = $this->error;
        $code = $this->_code($exception);

        if ($exception instanceof \Rest\Routing\Exception\MissingTokenException ||
            $exception instanceof \Rest\Routing\Exception\InvalidTokenException ||
            $exception instanceof \Rest\Routing\Exception\InvalidTokenFormatException
        ) {
            $message = $exception->getMessage();
        } else {
            $message = $this->_message($exception, $code);
        }

        $response = $this->_getController()->getResponse();

        if ($exception instanceof CakeException) {
            foreach ((array)$exception->responseHeader() as $key => $value) {
                $response = $response->withHeader($key, $value);
            }
        }
        $response = $response->withStatus($code);

        $viewVars = [
            'message' => $message,
            'code' => $code
        ];

        $isDebug = Configure::read('debug');

        if ($isDebug) {
            $viewVars['trace'] = Debugger::formatTrace($exception->getTrace(), [
                    'format' => 'array',
                    'args' => false
            ]);
            $viewVars['file'] = $exception->getFile() ? : 'null';
            $viewVars['line'] = $exception->getLine() ? : 'null';
        }

        $this->_getController()->set($viewVars);

        if ($exception instanceof CakeException && $isDebug) {
            $this->_getController()->set($exception->getAttributes());
        }

        $this->_getController()->setResponse($response);

        return $this->_prepareResponse();
    }

    /**
     * Generates the response using the controller object.
     *
     * @return \Cake\Http\Response A response object that can be sent.
     */
    protected function _prepareResponse(): \Cake\Http\Response
    {
        $this->_getController()->viewBuilder()->setClassName('Rest.Json');

        $this->_getController()->render();

        return $this->_shutdown();
    }
}
