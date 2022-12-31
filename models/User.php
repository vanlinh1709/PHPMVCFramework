<?php
namespace app\models;
use linhtv\phpmvc\DbModel;
use linhtv\phpmvc\Model;
use linhtv\phpmvc\UserModel;

class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE= 1;
    const STATUS_DELETED = 2;
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $password = '';
    public string $confirmPassword = '';
    public function save()
    {
        $this->status = self::STATUS_DELETED;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            "firstName" => [self::RULE_REQUIRED],
            "lastName" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => '8'], [self::RULE_MAX, 'max' => '24']],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstName', 'lastName', 'email', 'password', 'status'];
    }

    public function getDisplayName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

}