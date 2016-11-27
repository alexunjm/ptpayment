<?php
/**
 * Created by PhpStorm.
 * User: Eduard
 * Date: 27/11/2016
 * Time: 14:13
 */

namespace Pckg\Payment\Validate;


use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class Validator
{
    private static $validator;
    private static $errors;
    private static $params;

    private function __constructor()
    {
    }

    public static function initValid($params)
    {
        self::$validator = Validation::createValidator();
        self::$params = $params;

        foreach ($params as $key => $value) {
            if ($key == "payer" || $key == "buyer" || $key == "shipping" || $key == "additionalData") {
                foreach (self::$params[$key] as $index => $field)
                {
                    self::validNotBlank($index, $field);
                }
            } else {
                self::validNotBlank($key, $value);
            }
        }

        if (count(self::$errors) > 0)
            return array(
                    "status"  =>  "error",
            );

        return array(
            "status"  =>  "success",
        );
    }

    private static function validNotBlank($key, $value)
    {
        $violations = self::$validator->validate($value, array(
                new NotBlank(),
        ));

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                self::$errors[] = $violation->getMessage() . " $key ";
            }

            return false;
        }
    }

    public static function isValidPerson($person)
    {
        $violations = self::$validator->validate($person["payer"], array(
                new NotBlank(),
        ));

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                self::$errors[] = $violation->getMessage() . " <payer> ";
            }
            return false;
        }
    }
}