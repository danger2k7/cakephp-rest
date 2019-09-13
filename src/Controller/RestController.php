<?php
namespace Rest\Controller;

use Cake\Event\EventInterface;

class RestController extends AppController
{

    /**
     * beforeRender callback
     *
     * @param EventInterface $event An Event instance
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(EventInterface $event): void
    {
        parent::beforeRender($event);

        $this->viewBuilder()->setClassName('Rest.Json');
    }
}
