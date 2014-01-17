<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 08/01/2014
 * Time: 11:53
 */

include('../../core_incs.php');

$group = new Group();
$page = new Page();

$inputErrors = $group->getInputsErrorsFromSession();
$inputs = $group->getInputsFromSession();

$formHelper = new FormHelper(array('inputs' => $inputs, 'errors' => $inputErrors));
$formGen = new FormGenerator('group_create', $group->getProperty("createScriptPath"), 'post');

$tmp_section_title = "";
echo "<form method='post' action='". $group->getProperty("createScriptPath") ."'>";

echo $formGen->createElement(
    'text',
    'Group name',
    Group::TITLE, $formHelper->getFieldValue(G_TITLE, 'Enter name of group'),
    array('error' => $formHelper->getFieldError(G_TITLE))
);

$formGen->setSubmitButton('name', 'submit', '');
echo $formGen->createSubmitButton();

$arraySitemap = $page->getSiteMapWithPermissions();

$style = "style='display: inline-block; margin-left: 20px;'";

foreach($arraySitemap as $sectionId => $section){
    echo "<ol style='list-style:none;'>";
    echo "<h3>{$section['title']}</h3>";
    foreach ($section['pages'] as $pageId => $page) {
        $title = $page['title'];
        $code = $page['code'];
        $group = $page['grp_id'];
        $add_post = $page['add_post'];
        $add_comment = $page['add_comment'];
        $add_vote = $page['add_vote'];

        echo "<li><ul style='display: inline;'>";
        echo "<li $style>$title </li>";
        echo "<li $style>" . $formGen->createElement('checkbox', 'Display', 'pages', $pageId, array('class' => 'section_page', 'multiple' => TRUE));
        echo "<li $style>" . $formGen->createElement('checkbox', 'Add post', Permissions::ADD_POST .'-'. $pageId, '1', array('class' => 'section_page')) . "</li>";
        echo "<li $style>" . $formGen->createElement('checkbox', 'Add comment', Permissions::ADD_COMMENT .'-'. $pageId, '1', array('class' => 'section_page')) . "</li>";
        echo "<li $style>" . $formGen->createElement('checkbox', 'Add vote', Permissions::ADD_VOTE .'-'. $pageId, '1', array('class' => 'section_page')) . "</li>";
        echo "</ul></li>";
    }
    echo '</ol>';
}

echo "</form>";