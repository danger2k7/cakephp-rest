<?php

namespace TestApp\Controller;

use Cake\Http\Response;
use Rest\Controller\RestController;

/**
 * Foo Controller
 *
 */
class FooController extends RestController
{

    /**
     * bar method
     *
     * @return Response|void
     */
    public function bar()
    {
        $bar = [
            'falanu' => [
                'dhikanu',
                'tamburo'
            ]
        ];

        $this->set(compact('bar'));
    }

    /**
     * doe method
     *
     * @return Response|void
     */
    public function doe()
    {
        $data = [
            'requireToken' => true
        ];

        $this->set(compact('data'));
    }
}
