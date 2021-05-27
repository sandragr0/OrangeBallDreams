<?php

interface InterfaceDAO
{
    function view($id);

    function list();

    function add(object $objeto);

    function edit($id, object $objeto);

    function delete(object $objeto);
}