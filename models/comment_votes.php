<?php

class CommentVotes extends ModelAbstract{

    public function __construct(){
        parent::init(CV_PRM_KEY, CV_TABLE);
    }
} 