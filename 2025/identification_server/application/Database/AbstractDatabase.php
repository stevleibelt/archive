<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-04-19 
 */

namespace Database;

use Model\Hasher;
use Model\Identity;
use Service\Factory\IdentityFactory;
use Service\Locator;
use Service\LocatorDependentInterface;

/**
 * Class AbstractDatabase
 * @package Database
 */
abstract class AbstractDatabase implements DatabaseInterface, LocatorDependentInterface
{
    /** @var Hasher */
    protected $hasher;

    /** @var IdentityFactory */
    protected $identityFactory;

    /** @var Locator */
    protected $locator;

    /**
     * @param Locator $locator
     */
    public function setLocator(Locator $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @param Query $query
     * @throws \InvalidArgumentException
     */
    public function validateAuthorization(Query $query)
    {
        $this->validateQuery($query);
        $identity = $this->getIdentity($query);

        if (($identity instanceof Identity)
            && ($this->hasher->hash($query->getPassword()) === $identity->getHashedPassword())
            && ($identity->getValidUntil() >= time())) {
        } else {
            throw new \InvalidArgumentException('unknown identity or wrong name/password combination');
        }
    }

    /**
     * @param Hasher $hasher
     */
    public function setHasher(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param IdentityFactory $factory
     */
    public function setIdentityFactory(IdentityFactory $factory)
    {
        $this->identityFactory = $factory;
    }

    /**
     * @param Query $query
     * @throws \InvalidArgumentException
     */
    protected function validateQuery(Query $query)
    {
        if (!($query->hasId()
            || ($query->hasName() && $query->hasPassword()))) {
            throw new \InvalidArgumentException('query is not valid');
        }
    }
} 