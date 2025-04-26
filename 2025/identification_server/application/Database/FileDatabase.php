<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2014-03-26
 */

namespace Database;

use Model\Identity;

/**
 * Class FileDatabase
 * @package Database
 */
class FileDatabase extends AbstractDatabase
{
    /** @var array */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param Query $query
     * @return null|Identity
     * @throws \InvalidArgumentException
     */
    public function getIdentity(Query $query)
    {
        $this->validateQuery($query);
        $identity = null;
        $hashedName = $this->hasher->hash($query->getName());

        foreach ($this->data as $key => $values) {
            if ($values['hashed_name'] === $hashedName) {
                $values['id'] = $key;
                $values['name'] = $query->getName();
                $identity = $this->createIdentity($values);
                break;
            }
        }

        return $identity;
    }

    private function createIdentity(array $values)
    {
        $identity = $this->identityFactory->create($this->locator);

        $identity->setId($values['id']);
        $identity->setName($values['name']);
        $identity->setHashedPassword($values['hashed_password']);
        $identity->setValidUntil($values['valid_until']);

        return $identity;
    }
}
