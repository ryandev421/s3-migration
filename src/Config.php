<?php
declare(strict_types=1);

namespace src;

class Config {
	public static $AWS_CLIENT = [
		'version' => 'latest',
		'region' => 'us-west-2',
		'credentials' => [
			'key' => 'key',
			'secret' => 'secret'
		]
	];

	public static $BUCKET_NAME = 'active123';

	public static $ABSOLUTE_DIRS_TO_BE_MIGRATED = [
		'/Users/RyanPark/Projects',
		'/Users/RyanPark/Samples',
	];

	public static $IS_MIGRATE_RECURSIVE = true;
}
