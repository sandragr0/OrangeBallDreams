<?php

/**
 * Interface InterfaceDAO
 * @author Sandra <a href="mailto:sandraguerreror1995@gmail.com">sandraguerreror1995@gmail.com</a>
 */
interface InterfaceDAO
{
    /**
     * Function view
     * @param $id
     * @return mixed
     */
    function view($id);

    /**
     * Function list
     * @return mixed
     */
    function list();

    /**
     * Function add
     * @param object $objeto
     * @return mixed
     */
    function add(object $objeto);

    /**
     * Function edit
     * @param $id
     * @param object $objeto
     * @return mixed
     */
    function edit($id, object $objeto);

    /**
     * Function delete
     * @param object $objeto
     * @return mixed
     */
    function delete(object $objeto);
}