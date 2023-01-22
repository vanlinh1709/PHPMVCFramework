<?php

namespace app\core;

abstract class Model
{
    public array $errors = [];
    public array $rules = [];
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL= 'email';
    public const RULE_MIN= 'min';
    public const RULE_MAX= 'max';
    public const RULE_MATCH= 'match';
    
    abstract public function rules(): array;
    public function loadData($inputData)
    {
        foreach ($inputData as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->{$attribute} = $value;
            }
        }
    }
    public function validate() {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && empty($value)) {
//                    $this->errors[$attribute][] = 'This field is required';
                    $this->addErrors($attribute, $this->errorMessages()[$ruleName]);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, $this->errorMessages()[$ruleName]);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule[1]) {
                    $this->addErrors($attribute, str_replace('{min}', $rule[1], $this->errorMessages()[$ruleName]));
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule[1]) {
                    $this->addErrors($attribute, str_replace('{max}', $rule[1], $this->errorMessages()[$ruleName]));
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule[1]}) {
                    $this->addErrors($attribute, str_replace('{match}', $rule[1], $this->errorMessages()[$ruleName]));
                }
            }
         }
        return empty($this->errors);
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
        ];
    }

    public function addErrors($attribute, $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }
    abstract public function labels();
}
