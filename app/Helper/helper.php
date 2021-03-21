<?php

/**
 * Returns the admin user.
 *
 * @return Admin
 */
function ssh_tunnel_call() : void
{
    if (app()->environment('production')) {
        shell_exec("ssh -i /usr/home/hzkmbi/.ssh/id_rsa_adomino_com -f -N root@85.236.47.216 -L 33306:127.0.0.1:3306 && echo 'Done'");
    }
}
