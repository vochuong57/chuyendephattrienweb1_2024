<?php
declare(strict_types=1);

require_once 'A.php';  // Nhúng file chứa class A
require_once 'B.php';  // Nhúng file chứa class B
require_once 'C.php';  // Nhúng file chứa class C
require_once 'I.php';  // Nhúng file chứa interface I

class Demo {
    //-----------------typeAreturnY

    public function typeAreturnA(): A {
        echo __FUNCTION__ . "<br>";
        return new A();
    }
    
    public function typeAreturnB(): A {
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    public function typeAreturnC(): A {
        echo __FUNCTION__ . "<br>";
        return new C();
    }

    public function typeAreturnI(): A {
        echo __FUNCTION__ . "<br>";
        return new I();
    }

    public function typeAreturnNull(): A {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    //-----------------typeBreturnY

    public function typeBreturnB(): B {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
    
    public function typeBreturnC(): B {
        echo __FUNCTION__ . "<br>";
        return new C();
    }

    public function typeBreturnA(): B {
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    public function typeBreturnI(): B {
        echo __FUNCTION__ . "<br>";
        return new I();
    }

    public function typeBreturnNull(): B {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    //-----------------typeCreturnY

    public function typeCreturnC(): C {
        echo __FUNCTION__ . "<br>";
        return new C();
    }
    
    public function typeCreturnB(): C {
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    public function typeCreturnA(): C {
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    public function typeCreturnI(): C {
        echo __FUNCTION__ . "<br>";
        return new I();
    }

    public function typeCreturnNull(): C {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    //-----------------typeIreturnY

    public function typeIreturnI(): I {
        echo __FUNCTION__ . "<br>";
        return new I();
    }
    
    public function typeIreturnA(): I {
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    public function typeIreturnB(): I {
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    public function typeIreturnC(): I {
        echo __FUNCTION__ . "<br>";
        return new C();
    }

    public function typeIreturnNull(): I {
        echo __FUNCTION__ . "<br>";
        return null;
    }
    

    //-----------------typeNullreturnY

    public function typeNullreturnNull(): null{
        echo __FUNCTION__ . "<br>";
        return null;
    }

    public function typeNullreturnA(): null{
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    public function typeNullreturnB(): null{
        echo __FUNCTION__ . "<br>";
        return new B();
    }

    public function typeNullreturnC(): null{
        echo __FUNCTION__ . "<br>";
        return new C();
    }

    public function typeNullreturnI(): null{
        echo __FUNCTION__ . "<br>";
        return new I();
    }
}

// Tạo đối tượng từ lớp Demo và gọi các phương thức
$demo = new Demo();

$demo->typeAreturnA();
$demo->typeAreturnB();
$demo->typeAreturnC();
$demo->typeAreturnI();
$demo->typeAreturnNull();

$demo->typeBreturnB();
$demo->typeBreturnC();
$demo->typeBreturnA();
$demo->typeBreturnI();
$demo->typeBreturnNull();

$demo->typeCreturnC();
$demo->typeCreturnA();
$demo->typeCreturnB();
$demo->typeCreturnI();
$demo->typeCreturnNull();

$demo->typeIreturnI();
$demo->typeIreturnA();
$demo->typeIreturnB();
$demo->typeIreturnC();
$demo->typeIreturnNull();

$demo->typeNullreturnNull();
$demo->typeNullreturnA();
$demo->typeNullreturnB();
$demo->typeNullreturnC();
$demo->typeNullreturnI();