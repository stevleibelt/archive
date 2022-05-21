<?php

namespace library\Net\Bazzline\Cronjob\Distribute;

use Exception;

abstract class DistributeAbstract implements DistributeInterface
{
	private static $ROLE_OBSERVER = 0;
	private static $ROLE_SUBJECT = 1;

	private $subjects;

	/**
	 * @author stev leibelt
	 * @return \Net\Bazzline\Cronjob\DistributeAbstract
	 * @since 2013-01-03
	 */
	public static function createAsObserver()
	{
		$observer = new self(self::$ROLE_OBSERVER);

		return $observer;
	}

	/**
	 * @author stev leibelt
	 * @return \Net\Bazzline\Cronjob\DistributeAbstract
	 * @since 2013-01-03
	 */
	public static function createAsSubject()
	{
		$subject = new self(self::$ROLE_SUBJECT);

		return $subject;
	}

	/**
	 * @author stev leibelt
	 * @param integer $role
	 * @since 2013-01-03
	 */
	private function __construct($role)
	{
		if (in_array($role, array(self::$ROLE_OBSERVER, self::$ROLE_SUBJECT))) {
			$this->role = $role;
		}

		$this->subjects = array();
	}

	/**
	 * @author stev leibelt
	 * @since 2013-01-03
	 * @var integer
	 */
	private $role;

	/**
	 * @author stev leibelt
	 * @return boolean
	 * @since 2013-01-03
	 */
	public function isObserver()
	{
		return $this->getRole() === self::$ROLE_OBSERVER;
	}

	/**
	 * @author stev leibelt
	 * @return boolean
	 * @since 2013-01-03
	 */
	public function isSubject()
	{
		return $this->getRole() === self::$ROLE_SUBJECT;
	}

	/**
	 * @author stev leibelt
	 * @param array $parameters
	 * @return self
	 * @since 2013-01-03
	 */
	public abstract function createSubject(array $parameters = array());
//	{
//		$subject = self::createAsSubject();
//
//		$subjectMethods = get_class_methods($subject);
//
//		foreach ($parameters as $name => $value) {
//			$setterMethod = 'set' . ucfirst($name);
//
//			if (in_array($setterMethod, $subjectMethods)) {
//				$subject->$setterMethod($value);
//			}
//		}
//
//		return $subject;
//	}

	/**
	 * @author stev leibelt
	 * @param self $subject
	 * @since 2013-01-03
	 */
	protected function addSubject(self $subject)
	{
		if ($subject->isSubject()) {
			$this->subjects[] = $subject;
		} else if ($subject->isObserver()) {
			throw new Exception('You can not add a observer as a subject.');
		}
	}

	/**
	 * @author stev leibelt
	 * @return integer
	 * @since 2013-01-03
	 */
	protected function getRole()
	{
		return $this->role;
	}
}