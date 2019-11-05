<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use mysql_xdevapi\Exception;
use Psy\Exception\ErrorException;
use Symfony\Component\Mime\Exception\LogicException;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @template "$firstName $middleName $lastName"
     *
     */
    public function getUserName()
    {
        $firstName = $this->firstName;
        $middleName = $this->middleName;
        $lastName = $this->lastName;
        $email = $this->email;

        $reflector = new \ReflectionMethod('App\User', 'getUserName');
        $doc = $reflector->getDocComment();
        $regExp = '~@template.+"(\$[0-9A-Z]+)* *(\$[0-9A-Z]+)* *(\$[0-9A-Z]+)*"~mi';
        preg_match_all($regExp, $doc, $matches);

        if(null == array_shift($matches)) {
            return null;
        }

        foreach ($matches as $var) {
            $var = str_replace('$','', reset($var));
            if(!empty($var) && !empty($$var)) {
                $validVarsValues[] = $$var;
            }
        }

        if ($firstName != null && $lastName != null) {
            return implode(' ', $validVarsValues);
        }

        return $email;
    }
}
