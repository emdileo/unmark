<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_model extends Plain_Model
{

    public $sort = 'name ASC';


    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        // Set data types
        $this->data_types = array(
            'name' => 'string'
        );

    }

    public function create($options=array())
    {

        $valid  = validate($options, $this->data_types, array('name'));

        // Make sure all the options are valid
        if ($valid === true) {


            // See if this record already exists
            $tag = $this->read("LOWER(tags.name) = '" . $options['name'] . "'", 1, 1);

            // If not, add it
            if ($total < 1) {
                $q    = $this->db->insert_string($this->table, $options);
                $res  = $this->db->query($q);

                // Check for errors
                $this->sendException();

                // If good, return full label
                if ($res === true) {
                    $tag_id = $this->db->insert_id();
                    return $this->read($tag_id);
                }

                // Else return error
                return $this->formatErrors('Tag could not be added. Please try again.');
            }

            return $tag;

        }

        return $this->formatErrors($valid);
    }

}