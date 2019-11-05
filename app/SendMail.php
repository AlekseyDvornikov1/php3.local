<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 31.10.2019
 * Time: 19:04
 */

namespace App;


use Illuminate\Support\Facades\Mail;

class SendMail extends Mail
{
    protected function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}
