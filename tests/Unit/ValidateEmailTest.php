<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 31.10.2019
 * Time: 19:17
 */

namespace Tests\Unit;


use App\SendMail;
use Tests\TestCase;

class ValidateEmailTest extends TestCase
{
    protected $valid = [
      'email@example.com',
    'firstname.lastname@example.com',
    'email@subdomain.example.com',
    'firstname+lastname@example.com',
    'email@[123.123.123.123]',
    '1234567890@example.com',
    'email@example-one.com',
    'email@example.name',
    'email@example.museum',
    'email@example.co.jp',
    'firstname-lastname@example.com'
    ];

    protected $invalid = [
    'plainaddress',
    '#@%^%#$@#$@#.com',
    '@example.com',
    'Joe Smith <email@example.com>',
    'email.example.com',
    'email@example@example.com',
    '.email@example.com',
    'email.@example.com',
    '.email@example.com',
    'あいうえお@example.com',
    'email@example.com (Joe Smith)',
    'email@example',
    'email@-example.com',
    'email@111.222.333.44444',
    'email@example..com',
    'Abc..123@example.com'
];

    public function testValidMail()
    {
        $mailer = new SendMail();
        $reflection = new \ReflectionMethod('App\SendMail','validateEmail');
        $reflection->setAccessible(true);
        $validEmails = $this->valid;
        foreach ($validEmails as $validEmail) {
           $isValid = $reflection->invoke($mailer,$validEmail);
           $this->assertTrue($isValid, $validEmail);
        }
    }

    public function testInvalidMail()
    {
        $mailer = new SendMail();
        $reflection = new \ReflectionMethod('App\SendMail','validateEmail');
        $reflection->setAccessible(true);
        $invalidEmails = $this->invalid;
        foreach ($invalidEmails as $invalidEmail) {
            $isValid = $reflection->invoke($mailer,$invalidEmail);
            $this->assertFalse($isValid, $invalidEmail);
        }
    }
}
