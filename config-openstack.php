<?php

use OpenStack\Compute\v2\Models\Server;

$openstack = new OpenStack\OpenStack([
    'authUrl' => 'http://192.168.1.105/identity/v3',
    'region' => 'RegionOne',
    'user' => [
        'id' => '60103e5ab314471eba01eeb20ab0ff24',
        'password' => 'suttocdo'
    ],
    'scope' => ['project' => ['id' => '5354881b559945eea016d45a6f182dfd']]
]);

$compute = $openstack->computeV2(['region' => 'RegionOne']);

$server = $compute->getServer(['id' => '809a701b-552d-4aae-94eb-ab291d42ada5']);
$server1 = $compute->getServer(['id' => '5a83b510-c759-44d9-acb7-8e54a0bb6306']);

return [
    'openstack' => $openstack,
    'compute' => $compute,
    'server' => $server,
    'server1' => $server1
];