<?php
declare(strict_types=1);

namespace src;

use Aws\S3\S3Client;
use Monolog\Logger;

class S3ClientHelper {

	/**
	 * @var S3Client
	 */
	private static $instance;

	/**
	 * @param Logger|null $logger
	 *
	 * @return S3Client
	 * @throws \Exception
	 */
	public static function getInstance(Logger $logger = null)
	{
		if(self::$instance === null) {
			try {
				self::$instance = new S3Client(Config::$AWS_CLIENT);
			} catch (\Exception $e) {
				$logger->error($e->getMessage());
				throw $e;
			}
		}

		return self::$instance;
	}
}
