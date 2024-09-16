<?php

use OpenStack\Compute\v2\Models\Server;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$openstack = new OpenStack\OpenStack([
    'authUrl' => $_ENV['stack_authUrl'],
    'region' => $_ENV['stack_region'],
    'user' => [
        'id' => $_ENV['stack_userID'],
        'password' => $_ENV['stack_password']
    ],
    'scope' => ['project' => ['id' => $_ENV['stack_projectID']]]
]);

$compute = $openstack->computeV2(['region' => $_ENV['stack_region']]);

$server = $compute->getServer(['id' => $_ENV['stack_attackerID']]);
$server1 = $compute->getServer(['id' => $_ENV['stack_targetID']]);

return [
    'openstack' => $openstack,
    'compute' => $compute,
    'server' => $server,
    'server1' => $server1
];