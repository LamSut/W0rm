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

* .env
mysql_host='localhost'
mysql_username='root'
mysql_password=''
mysql_database='hack'
mysql_port='3307'

stack_authUrl='http://192.168.1.100/identity/v3'
stack_region='RegionOne'

stack_userID='f88d6cd3c7fe4a1eb36974bffe90187c'
stack_password='suttocdo'

stack_projectID='03fd442c1d2d45d8bda30c56b4c1e2c4'

stack_attackerID='1e5ac608-0e84-474f-8515-4c1f28120b5d'
stack_targetID='ad966429-a074-418f-a4e4-61943efd2ec0'

