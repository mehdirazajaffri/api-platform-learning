<?php

namespace App\Factory;

use App\Entity\Greeting;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Greeting>
 *
 * @method        Greeting|Proxy                   create(array|callable $attributes = [])
 * @method static Greeting|Proxy                   createOne(array $attributes = [])
 * @method static Greeting|Proxy                   find(object|array|mixed $criteria)
 * @method static Greeting|Proxy                   findOrCreate(array $attributes)
 * @method static Greeting|Proxy                   first(string $sortedField = 'id')
 * @method static Greeting|Proxy                   last(string $sortedField = 'id')
 * @method static Greeting|Proxy                   random(array $attributes = [])
 * @method static Greeting|Proxy                   randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Greeting[]|Proxy[]               all()
 * @method static Greeting[]|Proxy[]               createMany(int $number, array|callable $attributes = [])
 * @method static Greeting[]|Proxy[]               createSequence(iterable|callable $sequence)
 * @method static Greeting[]|Proxy[]               findBy(array $attributes)
 * @method static Greeting[]|Proxy[]               randomRange(int $min, int $max, array $attributes = [])
 * @method static Greeting[]|Proxy[]               randomSet(int $number, array $attributes = [])
 */
final class GreetingFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Greeting $greeting): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Greeting::class;
    }
}
