<?php
/**
 * Read and inject configuration
 */
try {
    Cake\Core\Configure::load('Rest.rest', 'default', false);
    Cake\Core\Configure::load('rest', 'default', true);
} catch (\Exception $e) {
    // do nothing
}
