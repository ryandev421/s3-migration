# s3-migration

This can migrate local files to S3 bucket.

## HOW TO USE

1. Download this repository.
2. Implement `composer install` in base directory(.../s3-migration/).
3. Rewrite configuration file (`Config.php` in src)
    (If you don't know what is credential key, you can check here. http://docs.aws.amazon.com/IAM/latest/UserGuide/id_credentials_access-keys.html)
4. Run! `php migration.php` In src.

## License
Feather is licensed under the [MIT License](https://github.com/ryanpark91/s3-migration/blob/master/LICENSE).
