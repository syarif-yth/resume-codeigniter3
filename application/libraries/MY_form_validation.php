<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ----------------------------------------------------------------------------
 * Editor   : PhpStorm 2017.1.1
 * Date     : 2/5/2017
 * Time     : 6:29 AM
 * Authors  : Raymond L King Sr.
 * ----------------------------------------------------------------------------
 *
 * Class        MY_Form_validation
 *
 * @project     csdmodule
 * @author      Raymond L King Sr.
 * @link        http://www.procoversfx.com
 * @copyright   Copyright (c) 2009 - 2017 Pro Covers FX, LLC.
 * @license     http://www.procoversfx.com/license
 * ----------------------------------------------------------------------------
 */

/**
 * Class MY_Form_validation
 *
 * place into ./application/libraries
 * 
 * use like this
 * if ($this->form_validation->run($this) == FALSE)
 * {
 *
 * }
 * else
 * {
 *
 * }
 */
class MY_form_validation extends CI_Form_validation
{

    /**
     * Class properties - public, private, protected and static.
     * ------------------------------------------------------------------------
     */


    // ------------------------------------------------------------------------

    /**
     * run ()
     * ---------------------------------------------------------------------------
     *
     * @param   string $module
     * @param   string $group
     * @return  bool
     */
    public function run($module = '', $group = '')
    {
        (is_object($module)) AND $this->CI = &$module;

        return parent::run($group);
    }

    // ------------------------------------------------------------------------

}   // End of MY_Form_validation Class.

/**
 * ----------------------------------------------------------------------------
 * Filename: MY_Form_validation.php
 * Location: ./application/libraries/MY_Form_validation.php
 * ----------------------------------------------------------------------------
 */ 
