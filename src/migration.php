<?php

namespace src;

require_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger('s3_migration');
$logger->pushHandler(new StreamHandler("php://stdout"));
$logger->pushHandler(new StreamHandler('./log/s3-migration.log'));


function doMigration($current_dir, Logger $logger)
{
	$client = S3ClientHelper::getInstance($logger);

	if ($handle = opendir($current_dir)) {
		while (false !== ($file = readdir($handle))) {
			if ($file == "." || $file == "..") continue;

			if (is_dir($current_dir . '/' . $file)) {
				if (Config::$IS_MIGRATE_RECURSIVE) {
					doMigration($current_dir . '/' . $file, $logger);
				}
			} else {
				$key = substr($file, 0, 1) . '/' . $file;

				try {
					$client->putObject([
						'Bucket' => Config::$BUCKET_NAME,
						'Key' => $key,
						'SourceFile' => $current_dir . '/' . $file
					]);

					$logger->info($current_dir . '/' . $file . ' => ' . $key);
				} catch (\Exception $e) {
					$logger->error($current_dir . '/' . $file . ' => ' . $key);
					$logger->error($e->getMessage());
				}
			}
		}
		closedir($handle);
	}
}

try {
	foreach (Config::$ABSOLUTE_DIRS_TO_BE_MIGRATED as $dir_name) {
		doMigration($dir_name, $logger);
	}
} catch (\Exception $e) {
	$logger->error($e->getMessage());
	throw $e;
}
