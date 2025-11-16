<?php

namespace App\Tests;

use App\Repository\ProductRepository;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DatabaseBetweenTestCasesTest extends WebTestCase
{
    private $client;
    private $productRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $client = static::createClient();
        $this->productRepository = $client->getContainer()->get(ProductRepository::class);
        $this->client = $client;
    }

    #[Test]
    public function testFoo(): void
    {
        $this->assertSame(0, count($this->productRepository->findAll()));

        $this->client->request(
            'POST',
            '/product',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'title' => 'Laptop',
                'price' => 3999.99
            ])
        );

        $this->assertSame(1, count($this->productRepository->findAll()));
    }

    #[Test]
    public function databaseIsIndependantFromPreviousOne(): void
    {
        $this->client->catchExceptions(false);

        $this->assertSame(0, count($this->productRepository->findAll()));
    }

}
