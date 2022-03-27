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
 * @package    profilefield_orcid
 * @category   profilefield
 * @copyright  2022 Carlos J. Palacios
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class profile_field_orcid extends profile_field_base {


    /**
     * Display the data for this field
     *
     * @return string data for custom profile field.
     */
    
            /**
     * Overwrite the base class to display the data for this field
     */
    public function display_data() {
        // Default formatting.
        $data = parent::display_data();

        // Are we creating a link?
        if (!empty($this->field->param4) and !empty($data)) {

            // Define the target.
            if (! empty($this->field->param5)) {
                $target = 'target="'.$this->field->param5.'"';
            } else {
                $target = '';
            }

            // Create the link.
            $icon = '<span class="media-left"><i class="icon fa fa-graduation-cap fa-fw " aria-hidden="true"></i></span>';
            $data = '<a href="'.str_replace('$$', urlencode($data), $this->field->param4).'" '.$target.'>'.$icon.htmlspecialchars($data).'</a>';
        }

        return $data;
    }



    /**
     * Adds the profile field to the moodle form class
     *
     * @param moodleform $mform instance of the moodleform class
     */
    public function edit_field_add($mform) {
        $size = 19;
        $maxlength = 19;
        $fieldtype = 'text';

        // Create the form field.
        $mform->addElement($fieldtype, $this->inputname, format_string($this->field->name), 'maxlength="'.$maxlength.'" size="'.$size.'" ');
        $mform->setType($this->inputname, PARAM_TEXT);
    }



    /**
     * Sets the default data for the field in the form object
     *
     * @param moodleform $mform instance of the moodleform class
     */
    //function edit_field_set_default(&$mform) {
       // if (!empty($default)) {
        //    $mform->setDefault($this->inputname, $this->field->defaultdata);
      //  }
  ////  }

    /**
     * Validate the form field from profile page
     *
     * @param stdClass $usernew user input
     * @return string contains error message otherwise NULL
     **/
    function edit_validate_field($usernew) {
        // overwrite if necessary
        $errors = array();

        // Revisamos que se haya pasado un orcid contra el regex

	$arreglo = $array = get_object_vars($usernew);



        if ( !preg_match('/(\d{4}\-\d{4}\-\d{4}\-\d{3}(?:\d|X))/', $arreglo[$this->inputname] ) ){

           $errors[$this->inputname] = "Invalid ORCID error-".preg_last_error();	
	}

       

//var_dump($arreglo);exit();
//$errors['username'] = "Bumbata";	
       

        return $errors;

    }

    /**
     * Process the data before it gets saved in database
     *
     * @param stdClass $data from the add/edit profile field form
     * @param stdClass $datarecord The object that will be used to save the record
     * @return stdClass
     */
/*
    function edit_save_data_preprocess($data, &$datarecord) {
        return $data;
    }
]/
    /**
     * HardFreeze the field if locked.
     *
     * @param moodleform $mform instance of the moodleform class
     */
  
/*
  function edit_field_set_locked($mform) {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }
        if ($this->is_locked() and !has_capability('moodle/user:update', get_context_instance(CONTEXT_SYSTEM))) {
            $mform->hardFreeze($this->inputname);
            $mform->setConstant($this->inputname, $this->data);
        }
    }
*/

    /**
     * Return the field type and null properties.
     * This will be used for validating the data submitted by a user.
     *
     * @return array the param type and null property
     * @since Moodle 3.2
     */
    public function get_field_properties() {
        return array(PARAM_TEXT, NULL_NOT_ALLOWED);
    }
}

