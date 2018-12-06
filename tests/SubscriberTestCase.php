<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class SubscriberTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate:fresh');
        $this->populateSuscribers();
    }

    public function populateSuscribers()
    {
        \Artisan::call('db:seed');
    }
}
