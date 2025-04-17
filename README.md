# Cloud-based Ethical Hacking Training Ground 

PHP web application for Information Security education, utilizing the OpenStack cloud platform for constructing security testing practice environment. Refer to this document for additional details: [THS2024-77](https://github.com/LamSut/THS2024-77/blob/master/THS2024-77.pdf)

### Objectives

* Building a security testing practice environment and providing knowledge about Information Security.
* Implementing lectures and challenges in the field of Information Security.
* Integrating Cloud Computing technology to build Attack VMs and Target VMs for security testing exercises.

### Key Components

OpenStack private cloud computing infrastructure manages attack and target VMs for security testing challenges deployed on the web application. The application consists of three parts:
* Classes will provide knowledge in the field of Information Security for students through lectures and documents.
* CTF challenges with topics such as Forensics, Web Exploitation, Reverse Engineering, Cryptography,...
* Security testing exercises will be practiced by students through the VNC Console on the application.

---
![image](https://github.com/user-attachments/assets/c4d0d4c6-296a-4863-817a-32a7ecbe229c)

---
![Screenshot 2024-09-18 075419](https://github.com/user-attachments/assets/42b89075-a3cc-4f23-86ee-46a475260d4d)
---

### Requirements

* PHP >= 7.2.5
* `ext-curl`
* Composer

### How to install

```bash
composer require php-opencloud/openstack
```
```bash
composer require vlucas/phpdotenv
```

### Configuration

Create a `.env` file in your project root directory (the same directory as your composer.json file).  
Inside the `.env` file, define your environment variables using the following syntax:

```bash
MYSQL_HOST=
MYSQL_USERNAME=
MYSQL_PASSWORD=
MYSQL_DATABASE=
MYSQL_PORT=

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

