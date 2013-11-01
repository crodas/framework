<?php

/**
 *  @Route /
 *  @View home.tpl
 */
function get_home($req)
{
    return ['random' => rand(0, 999)];
}
