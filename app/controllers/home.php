<?php

/**
 *  @Route /
 *  @View home.tpl
 */
function get_home($req)
{
    return ['random' => rand(0, 999)];
}

/**
 *  @Route /protected
 *  @Auth
 */
function get_protected($req)
{
    $user = Auth::user();

    // I should be in a view, but who cares?
    echo "hi {$user->email} this is a protected page";
}
