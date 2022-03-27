<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Contains definition of cutsom user profile field.
 *
 * @package    profilefield_orcid
 * @category   profilefield
 * @copyright  2022 Carlos J. Palacios
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
//Warning: Declaration of profile_define_orcid::define_form_specific(&$form) should be compatible with 
//profile_define_base::define_form_specific($form) in /var/www/html/user/profile/field/orcid/define.class.php on line 34
class profile_define_orcid extends profile_define_base {

    /**
     * Prints out the form snippet for the part of creating or
     * editing a profile field specific to the current data type
     *
     * @param moodleform $form reference to moodleform for adding elements.
     */
    function define_form_specific($form) {

        //Parametros tomados del text_profilefield por su similitud

        // Default data.
        $form->addElement('text', 'defaultdata', get_string('profiledefaultdata', 'admin'), 'size="50"');
        $form->setType('defaultdata', PARAM_TEXT);

        // Param 4 for text type contains a link.
        $form->addElement('text', 'param4', get_string('profilefieldlink', 'admin'));
        $form->setType('param4', PARAM_URL);
        $form->addHelpButton('param4', 'profilefieldlink', 'admin');

        // Param 5 for text type contains link target.
	// Incluimos el target por razon de si desea que nlace a otra uri y no poner fijo orcid.org
        $targetoptions = array( ''       => get_string('linktargetnone', 'editor'),
                                '_blank' => get_string('linktargetblank', 'editor'),
                                '_self'  => get_string('linktargetself', 'editor'),
                                '_top'   => get_string('linktargettop', 'editor')
                              );
        $form->addElement('select', 'param5', get_string('profilefieldlinktarget', 'admin'), $targetoptions);
        $form->setType('param5', PARAM_RAW);
    }



    /**
     * Validate the data from the add/edit profile field form
     * that is specific to the current data type
     *
     * @param object $data from the add/edit profile field form
     * @param object $files files uploaded
     * @return array associative array of error messages
     */
    function define_validate_specific($data, $files) {
        // overwrite if necessary
        $errors = array();

        // Revisamos que se haya pasado un orcid contra el regex
        //if ($data->param1 > $data->param2) {
          //  $errors['param1'] = get_string('startyearafterend', 'profilefield_datetime');
        //}
        if ($data->defaultdata!='' && !preg_match('/(\d{4}\-\d{4}\-\d{4}\-\d{3}(?:\d|X))/', $data->defaultdata) ){
           $errors['defaultdata'] = "Invalid ORCID error-".preg_last_error();	
	}
	//else{
        //$errors['defaultdata'] = "ok kuki";	
        //}
       



        return $errors;
    }

    /**
     * Alter form based on submitted or existing data
     *
     * @param moodleform $mform reference to moodleform
     */
   // function define_after_data(&$mform) {
        // overwrite if necessary
    //}

    /**
     * Preprocess data from the add/edit profile field form
     * before it is saved.
     *
     * @param object $data from the add/edit profile field form
     * @return object processed data object
     */
    //function define_save_preprocess($data) {
        // overwrite if necessary
    //}

}


