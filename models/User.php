<?php
namespace app\models;
use app\core\Model;

class User extends Model
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email= '';
    public string $password= '';
    public string $confirmPassword = '';

    public function tableName(): string
    {
        return 'user';
    }
    public function rules(): array
    {
        return [
            "firstname" => [self::RULE_REQUIRED],
            "lastname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED ,self::RULE_EMAIL],
            "password" => [[self::RULE_MIN, 8], [self::RULE_MAX, 24]],
            "confirmPassword" => [[self::RULE_MATCH, "password"]]
        ];
    }

    public function labels()
    {
        return
        [
            "firstname" => "First name",
            "lastname" => "Last name",
            "email" => "Your Email",
            "password" => "Password",
            "confirmPassword" => "Confirm Password"
        ];
    }
}