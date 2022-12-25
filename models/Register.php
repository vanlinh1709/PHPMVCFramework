<?php
namespace app\models;
use app\core\Model;

class Register extends Model
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;
    public function register()
    {
        echo 'Creating new user';
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            "firstName" => [self::RULE_REQUIRED],
            "lastName" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '8'], [self::RULE_MAX, 'max' => '24']],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }


}