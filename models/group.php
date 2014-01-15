<?php

class Group extends ModelAbstract{

    public function __construct(){
        parent::init(G_PRM_KEY, G_TABLE);
    }

    public function createGroupArray($grp_id, $_post){
        $group_id = $grp_id;
        $tmp_array = array();
        foreach($_post['page_id'] as $page_id){
            $tmp_array[$page_id] = array(
                "id_grp" => $group_id,
                "id_page" => $page_id,
                "display_post" => $this->getCheckboxValue($_post, 'display-' . $page_id),
                "add_post" => $this->getCheckboxValue($_post, 'add_post-' . $page_id),
                "add_comment" => $this->getCheckboxValue($_post, 'add_comment-' . $page_id),
                "add_vote" => $this->getCheckboxValue($_post, 'add_vote-' . $page_id)
            );
        }
        return $tmp_array;
    }

    public function createFormArray(){
        $dbc = new DbQueryManager();
        $query = "SELECT `". S_TABLE . "`.`". S_TITLE ."` AS 'section_title',
        `". S_TABLE ."`.`". S_PRM_KEY ."` AS 'section_id',
        `". S_TABLE ."`.`". S_CODE ."` AS 'section_code',
        `". PAG_TABLE ."`.`". PAG_PRM_KEY ."` AS page_id,
        `". PAG_TABLE ."`.`". PAG_TITLE ."` AS page_title,
        `". PAG_TABLE ."`.`". PAG_CODE ."` AS page_code,
        `". PE_TABLE ."`.`". PE_GROUP ."` AS permissions_group_id,
        `". PE_TABLE ."`.`". PE_ADD_POST ."` AS permissions_add_post,
        `". PE_TABLE ."`.`". PE_ADD_COMMENT ."` AS permissions_add_comment,
        `". PE_TABLE ."`.`". PE_ADD_vote ."` AS permissions_add_vote
            FROM ". PAG_TABLE ." LEFT JOIN ". S_TABLE ." ON `". PAG_TABLE ."`.`". PAG_SECTION ."` = `". S_TABLE ."`.`". S_PRM_KEY ."` LEFT JOIN ". PE_TABLE ." ON `". PE_TABLE ."`.`". PE_PAGE ."` = `". PAG_TABLE ."`.`". PAG_PRM_KEY ."`";

        $result = $dbc->selectQuery($query, "page_id");
        $form_array = Array(); // contains the array with sections and pages

        foreach($result as $page => $value){
            $section_title = $value['section_title'];
            $section_code = $value['section_code'];

            $page_id = $page;
            $page_title = $value['page_title'];
            $page_code = $value['page_code'];

            $permissions_group_id = $value['permissions_group_id'];
            $permissions_add_post = $value['permissions_add_post'];
            $permissions_add_comment = $value['permissions_add_comment'];
            $permissions_add_vote = $value['permissions_add_vote'];

            $form_array[] = Array(
                "section_id" => Array(
                    "title" => $section_title,
                    "code" => $section_code,
                    "pages" => Array(
                        "id" => $page_id,
                        "title" => $page_title,
                        "code" => $page_code,
                        "grp_id" => $permissions_group_id,
                        "add_post" => $permissions_add_post,
                        "add_comment" => $permissions_add_comment,
                        "add_vote" => $permissions_add_vote
                    )
                )
            );
        }

        return $form_array;
    }

    public function createForm($form_array){ //prints out the $form_array into a table
        $formGen = new FormGenerator('group_permissions', $this->getProperty("createScriptPath"), 'post');
        $tmp_section_title = "";
        if(isset($_GET['group_added']) && $_GET['group_added'] == true){
            echo "<div>---GROUP '". $_GET['group_name'] . "' HAS BEEN ADDED---</div>";
        }elseif(isset($_GET['group_added']) && $_GET['group_added'] == false){
            echo "<div>---ERROR: GROUP '". $_GET['group_name'] . "' HAS NOT BEEN ADDED---</div>";
        }
        echo "<form method='post' action='". $this->getProperty("createScriptPath") ."'>";
        //echo "<label style='width: 70px;display: inline-block;'>Group name</label><input type='text' name='new_group' />";
       echo $formGen->createElement('text', 'Group name', 'new_group', '');
       echo "<input type='submit' name='submit' />";
        foreach($form_array as $section => $value){
            foreach ($value as $section => $val) {
                $title = $val['title'];
                $code = $val['code'];
                $page = $val['pages'];

                $ul_end = "";

                if($tmp_section_title != $title){
                    $tmp_section_title = $title;


                    echo "</ol><ol style='list-style:none;'>";
                    echo "<h3>$title</h3>";
                }

                $id = $page['id'];
                $title = $page['title'];
                $code = $page['code'];
                $group = $page['grp_id'];
                $add_post = $page['add_post'];
                $add_comment = $page['add_comment'];
                $add_vote = $page['add_vote'];

                echo "<li><ul style='display: inline;'>";
                echo "<li style='display: inline-block; margin-left: 20px;'>" . $formGen->createElement('checkbox', $title, 'display-' . $id, '1', array('class' => 'section_page')) . "</li>";
                echo "<li style='display: inline-block; margin-left: 20px;'>" . $formGen->createElement('checkbox', 'Add post', 'add_post-' . $id, '1', array('class' => 'section_page')) . "</li>";
                echo "<li style='display: inline-block; margin-left: 20px;'>" . $formGen->createElement('checkbox', 'Add comment', 'add_comment-' . $id, '1', array('class' => 'section_page')) . "</li>";
                echo "<li style='display: inline-block; margin-left: 20px;'>" . $formGen->createElement('checkbox', 'Add vote', 'add_vote-' . $id, '1', array('class' => 'section_page')) . "</li>";
                //echo "<li style='display: inline-block; margin-left: 20px;'><label for='display-$id' style='width: 200px;display: inline-block;'>$title</label><input class='section_page' type='checkbox' name='display-$id' value='1' /><input type='hidden' name='page_id[]' value='$id'</li>";
                //echo "<li style='display: inline-block; margin-left: 20px;'><label for='add_post-$id' style='width: 70px;display: inline-block;'>Add post</label><input type='checkbox' name='add_post-$id' checked='checked' value='1' /></li>";
                //echo "<li style='display: inline-block; margin-left: 20px;'><label for='add_comment-$id' style='width: 100px;display: inline-block;'>Add comment</label><input type='checkbox' name='add_comment-$id' checked='checked' value='1' /></li>";
                //echo "<li style='display: inline-block; margin-left: 20px;'><label for='add_vote-$id' style='width: 70px;display: inline-block;'>Add vote</label><input type='checkbox' name='add_vote-$id' value='1' /></li>";
                echo "</ul></li>";

                echo $ul_end;
            }
        }
        echo "</form>";
    }
    
    public function createGroup($_post){
        $groupName = $_post['new_group'];
        $groupID = $this->createRecord(array(G_TITLE => $groupName));
        //adding permissions for the group
        $groupArray = $this->createGroupArray($groupID, $_post);// creating a multiple insert
        
        $permissions = new Permissions();
        $permissions->createRecord($groupArray, array('multiple_insert' => TRUE));
        
        return true;
    }


} 