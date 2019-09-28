<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 27.09.2019
 * Time: 10:51
 */

namespace Tests\Unit;


use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected function makeUser(
        $email,
        $firstName = null,
        $middleName = null,
        $lastName = null
    ): User
    {
        $user = new User();
        $user->firstName = $firstName;
        $user->middleName = $middleName;
        $user->lastName = $lastName;
        $user->email = $email;

        return $user;
    }

    public function testEmptyUser()
    {
        $user = $this->makeUser('test@gmail.com');
        $this->assertIsString('test@gmail.com',$user->getUserName());
        $this->assertEquals('test@gmail.com', $user->getUserName());
    }

    public function testFullUser()
    {
        $email = 'test@gmail.com';
        $firstName = 'Alexey';
        $middleName = 'Andreevich';
        $lastName = 'Dvornikov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);

        $this->assertIsString($user->getUserName());
        $this->assertSame(implode(' ', [
            $firstName,
            $middleName,
            $lastName,
        ]), $user->getUserName());

    }

    public function testWithoutFirstName()
    {
        $email = 'test@gmail.com';
        $firstName = '';
        $middleName = 'Andreevich';
        $lastName = 'Dvornikov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);

        $this->assertIsString($user->getUserName());
        $this->assertSame($email, $user->getUserName());
    }

    public function testWithoutLastName()
    {
        $email = 'test@gmail.com';
        $firstName = 'Alexey';
        $middleName = 'Andreevich';
        $lastName = '';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);

        $this->assertIsString($user->getUserName());
        $this->assertSame($email, $user->getUserName());
    }

    public function testWithoutMiddleName()
    {
        $email = 'test@gmail.com';
        $firstName = 'Alexey';
        $middleName = '';
        $lastName = 'Dvornikov';
        $user = $this->makeUser($email, $firstName, $middleName, $lastName);

        $this->assertIsString($user->getUserName());
        $this->assertSame(implode(' ',[$firstName, $lastName]), $user->getUserName());
    }

}
