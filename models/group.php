<?php

class Group extends ModelAbstract{

    const TABLE = 'group';
    const PRM_KEY = 'grp_id';

    const TITLE = 'title';
    const DESC = 'description';
    const CREATED = 'created';


    public function __construct(){
        parent::init(self::PRM_KEY, self::TABLE);
    }

    public function createGroup($_post){
        $groupName = $_post[self::TITLE];
        // validation;
        if ($this->recordExist(self::TITLE, $groupName)) return 'Group with name '.$_post[self::TITLE].' already exists';
        else{
            $groupID = $this->createRecord(array(self::TITLE => $groupName));
            //adding permissions for the group
            $permissions = new Permissions();
            $insertArrays = $permissions->createInsertArrays($_post, $groupID);// creating a multiple insert
            $permissions->createRecord($insertArrays, array('multiple_insert' => TRUE));
        }
    }


} 