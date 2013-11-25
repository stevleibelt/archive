<?php

namespace library\Net\Bazzline\Cronjob\Distribute;

/**
 * Interface for the distribution of a cronjob.
 *
 * @author stev leibelt
 * @since 2013-01-03
 */
interface DistributeInterface
{
	/**
	 * @author stev leibelt
	 * @return boolean
	 */
	public function isObserver();

	/**
	 * @author stev leibelt
	 * @return boolean
	 */
	public function isSubject();

	/**
	 * @author stev leibelt
	 * @param array $parameters
	 * @since 2013-01-03
	 */
	public function createSubject(array $parameters = array());
}