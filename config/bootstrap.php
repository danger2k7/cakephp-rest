<?php
/**
 * Read and inject configuration
 */

use Cake\Core\Configure;

try {
    \Cake\Core\Configure::load('Rest.rest');
//    \Cake\Core\Configure::load('rest', 'default', true);
} catch (\Exception $e) {
    debug($e->getMessage());die;
}
