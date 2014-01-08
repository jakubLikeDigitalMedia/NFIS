<?php

class PollVotes extends ModelAbstract{

    public function __construct(){
        parent::init(PV_PRM_KEY, PV_TABLE);
    }
} 