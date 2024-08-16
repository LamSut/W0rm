<?php

use OpenStack\Compute\v2\Models\Server;

$openstack = new OpenStack\OpenStack([
    'authUrl' => '',
    'region' => 'RegionOne',
    'user' => [
        'id' => '',
        'password' => ''
    ],
    'scope' => ['project' => ['id' => '']]
]);

$compute = $openstack->computeV2(['region' => 'RegionOne']);

$server = $compute->getServer(['id' => '']);
$server1 = $compute->getServer(['id' => '']);

return [
    'openstack' => $openstack,
    'compute' => $compute,
    'server' => $server,
    'server1' => $server1
];