<?php

$connection = ssh2_connect('192.168.168.171', 22);
ssh2_auth_password($connection, 'root', 'smepyguz33100123');

$stream1 = ssh2_exec($connection, 'asterisk -rx "pjsip list contacts"');

stream_set_blocking($stream1, true);
$stream_out = ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
$content = stream_get_contents($stream_out);

echo '<pre>'; print_r($content); echo '</pre>';


?>