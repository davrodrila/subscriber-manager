<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailRulesTest extends TestCase
{

    public function testIfDomainIsProperlyExtracted()
    {
        $validator = new \App\Rules\EmailDomain();
        $domain = $validator->getDomainFrom('test@gmail.com');
        $this->assertEquals('gmail.com', $domain);
    }

    public function testIfUsernameWithEscapedAtReturnsProperDomain()
    {
        $validator = new \App\Rules\EmailDomain();
        $domain = $validator->getDomainFrom('t\@st@gmail.com');
        $this->assertEquals('gmail.com', $domain);
    }
    public function testIfInvalidDomainIsDetected()
    {
        $validator = new \App\Rules\EmailDomain();

        $this->assertFalse($validator->passes('email', 'test@example.net'));
    }

    public function testIfValidDomainIsDetected()
    {
        $validator = new \App\Rules\EmailDomain();

        $this->assertTrue($validator->passes('email', 'test@gmail.com'));
    }
}
