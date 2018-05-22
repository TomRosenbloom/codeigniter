<?php

$config = array(
    array(
        'field' => 'first_name',
        'label' => 'First name',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'last_name',
        'label' => 'Last name',
        'rules' => 'trim|required'
    ),
    array(
        'field' => 'postcode',
        'label' => 'Postcode',
        'rules' => 'callback_validate_postcode'
    ),
    array(
        'field' => 'email',
        'label' => 'Email address',
        'rules' => 'required|valid_email'
    )
);
