<?php

class Announcement extends ModelAbstract{

    public function __construct(){
        parent::init(A_PRM_KEY, A_TABLE);
    }
} 