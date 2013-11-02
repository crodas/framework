<?php

/**
 *  @Route("/user/login", "user_login")
 *  @Method GET
 *  @View "form"
 */
function get_login($req)
{
    $form = new \crodas\Form\Form;
    return compact('form');
}

/**
 *  @Route("/user/login")
 *  @Method POST
 *  @View "form"
 */
function post_login($req)
{
    $form = new \crodas\Form\Form;
    $form->populate($_POST);
    if (Auth::attempt(['email' => $_POST['email'], 'password' => $_POST['password']])) {
        $next = !empty($_SESSION['intended']) ? $_SESSION['intended']  : '/';
        header("Location: $next");
        exit;
    }
    $error = "Invalid username or password";
    return compact('form', 'error');
}

/**
 *  @Route("/user/logout", "user_login")
 *  @Method GET
 */
function get_logout($req)
{
    Auth::logout();
    Header("Location: /");
    exit;
}

