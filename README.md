# W0rm

PHP web application for cybersecurity education, utilizing the OpenStack cloud platform for constructing attack/target machines.

## Objectives

* Building a security testing practice environment and providing knowledge about Information Security.
* Implementing lectures and challenges in the field of Information Security.
* Integrating Cloud Computing technology to build Attack VMs and Target VMs for security testing exercises.

## Key Components

OpenStack Cloud Computing Infrastructure manages attack and target VMs for security testing challenges  
deployed on the web application. The application consists of three parts:
* Classes will provide knowledge in the field of Information Security for students through lectures and documents.
* CTF challenges with topics such as Forensics, Web Exploitation, Reverse Engineering, Cryptography,...
* Security testing exercises will be practiced by students through the VNC Console on the application.

---
![Screenshot 2024-09-18 075419](https://github.com/user-attachments/assets/42b89075-a3cc-4f23-86ee-46a475260d4d)
---

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
The .env file is essential for storing sensitive configuration details like API keys, database credentials,...  
Never include your .env file in your version control system (e.g., Git).

