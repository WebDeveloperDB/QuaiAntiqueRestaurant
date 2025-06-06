<?php

declare(strict_types=1);

namespace Doctrine\Bundle\MongoDBBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;

use function assert;
use function sprintf;

/** @template T of object */
trait ServiceRepositoryTrait
{
    /**
     * @param ManagerRegistry $registry      The ManagerRegistry to use
     * @param string          $documentClass The class name of the entity this repository manages
     * @phpstan-param class-string<T> $documentClass
     */
    public function __construct(ManagerRegistry $registry, string $documentClass)
    {
        $manager = $registry->getManagerForClass($documentClass);
        assert($manager instanceof DocumentManager || $manager === null);

        if ($manager === null) {
            throw new LogicException(sprintf(
                'Could not find the document manager for class "%s". Check your Doctrine configuration to make sure it is configured to load this document’s metadata.',
                $documentClass,
            ));
        }

        parent::__construct($manager, $manager->getUnitOfWork(), $manager->getClassMetadata($documentClass));
    }
}
