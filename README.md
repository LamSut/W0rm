# W0rm

PHP web application for cybersecurity education, utilizing the OpenStack cloud platform for constructing attack/target machines.

## Requirements

* PHP >= 7.2.5
* `ext-curl`
* Composer

## How to install

```bash
composer require php-opencloud/openstack
```
```bash
composer require vlucas/phpdotenv
```

## Configuration

The .env file is essential for storing sensitive configuration details like API keys, database credentials, and other secrets. Here's how to create one:
Create a new file named .env in your project root directory (the same directory as your composer.json file).

Inside the .env file, define your environment variables using the following syntax:
```bash
mysql_host=
mysql_username=
mysql_password=
mysql_database=
mysql_port=

stack_authUrl=
stack_region=
stack_userID=
stack_password=

stack_projectID=

stack_attackerID=
stack_targetID=
```
Important:  Never commit your .env file to version control (e.g., Git). This is because it might contain sensitive information

