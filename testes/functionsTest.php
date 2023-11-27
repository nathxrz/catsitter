<?php declare(strict_types=1);
require('../includes/components/functions.php');

use PHPUnit\Framework\TestCase;

final class FunctionsTest extends TestCase
{
    public function testGetPetByIdSuccess(): void{
        $pdo = new PDO("mysql:host=localhost; dbname=catsitter; charset=utf8", "root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pet = getPetById(45, $pdo);

        // Verifica se o resultado não é nulo e se é um array (um pet foi encontrado)
        $this->assertNotNull($pet);
        $this->assertIsArray($pet);

        //traz as informações do pet
        $this->assertArrayHasKey('w', $pet);
        $this->assertArrayHasKey('sexo', $pet);
        $this->assertArrayHasKey('raca', $pet);
    }

    public function testGetPetByIdError(): void{
        $pdo = new PDO("mysql:host=localhost; dbname=catsitter; charset=utf8", "root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pet = getPetById(1, $pdo);

        //verifica se não existe o pet (false)
        $this->assertSame(true, $pet);
    }
}
