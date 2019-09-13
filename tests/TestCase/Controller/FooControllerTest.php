<?php

namespace Rest\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * FooControllerTest Test Case
 */
class FooControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Test method
     *
     * @return void
     * @throws \Throwable
     */
    public function testGet(): void
    {
        $this->get('/foo/bar');
        $this->assertResponseOk();
        $this->assertResponseCode(200);
        $this->assertResponseEquals('{"status":"OK","result":{"bar":{"falanu":["dhikanu","tamburo"]}}}');
    }

    /**
     * Test method
     *
     * @return void
     * @throws \Throwable
     */
    public function testGetWithHeaders(): void
    {
        $payload = [
            'id' => 1,
            'email' => "johndoe@example.com"
        ];

        $token = \Rest\Utility\JwtToken::generate($payload);

        $this->configRequest([
            'headers' => [
                'Authorization' => "Bearer {$token}"
            ]
        ]);

        $this->get('/foo/doe');

        $this->assertResponseOk();
        $this->assertResponseCode(200);
        $this->assertResponseEquals('{"status":"OK","result":{"data":{"requireToken":true}}}');
    }
}
