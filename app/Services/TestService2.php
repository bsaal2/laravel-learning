<?php
namespace App\Services;

class TestService2 implements TestServiceInterface {
    public function sayHello(): string {
        return 'Hello From TestService 2';
    }
}