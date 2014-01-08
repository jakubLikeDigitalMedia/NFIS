<?php

class PollAnswers extends ModelAbstract{

    public function __construct(){
        parent::init(PA_PRM_KEY, PA_TABLE);
    }
} 