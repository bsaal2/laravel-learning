<?php
namespace App\Services;

class TestService implements TestServiceInterface {
    private $fruitList = [];
    private string $name;

    public function sayHello(): string {
        return 'Hello, Developer from TestService 1';
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName($value): void {
        $this->name = $value;
    }

    public function setFruit($value): void {
        $this->fruitList[] = $value;
    }

    public function getFruit() {
        return $this->fruitList;
    }

    public static function staticSetFruit($value): TestService {
        $object = app()->make(TestService::class);
        $object->setFruit($value);
        return $object;
    }

    public static function staticGetFruit() {
        $object = app()->make(TestService::class);
        return $object->getFruit();
    }
}