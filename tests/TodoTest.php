<?php declare(strict_types=1);

namespace App\Tests;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Task;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class TodoTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', '/api/tasks');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertCount(30, $response->toArray()['hydra:member']);

    }

    public function testCreateTask(): void
    {
        static::createClient()->request('POST', '/api/tasks', ['json' => [
            'title' => 'Task 1',
            'description' => 'Task description',
            'type' => 'meeting',
            'isDone' => false,
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertMatchesResourceItemJsonSchema(Task::class);
    }

    public function testDeleteTask(): void
    {
        $client = static::createClient();
        $iri = $this->findIriBy(Task::class, ['id' => 1]);

        $client->request('DELETE', $iri);

        $this->assertResponseStatusCodeSame(204);
        $this->assertNull(
            static::$container->get('doctrine')->getRepository(Task::class)->findOneBy(['id' => 1])
        );
    }

    public function testUpdateTask(): void
    {
        $client = static::createClient();
        $iri = $this->findIriBy(Task::class, ['id' => 1]);

        $client->request('PUT', $iri, ['json' => [
            'title' => 'updated title',
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            '@id' => $iri,
            'title' => 'updated title',
        ]);
    }
}
