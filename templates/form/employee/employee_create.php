<?php
$htmlGen = HtmlGenerator::getInstance();
$brand = new Brand();
$position =  new Position();
$location = new Location();
$department = new Department();
$employee = new Employee();

$superiorList = $employee->getSuperiors();
$brandList = $brand->getPropertyList('title', 'title');
$positionList = $position->getPropertyList('title');
$locationList = $location->getPropertyList('title');
$departmentList = $department->getPropertyList('title');

$inputErrors = (isset($_SESSION['user']['errors']['current_empl']))? $_SESSION['user']['errors']['current_empl']: array();
$userInputs = (isset($_SESSION['user']['inputs']['current_empl']))? $_SESSION['user']['inputs']['current_empl']: array();

$formHelper = new FormHelper( array('inputs' => $userInputs, 'errors' => $inputErrors) );

$name = E_TABLE.SEP.E_NAME;
$name = array(
    'type' => 'text',
    'label' => 'Name',
    'name' => $name,
    'value' => $formHelper->getFieldValue($name, 'Enter your Name'),
    'options' => array('error' => $formHelper->getFieldError($name))
);

$surname = E_TABLE.SEP.E_SURNAME;
$surname = array(
    'type' => 'text',
    'label' => 'Surname',
    'name' => $surname,
    'value' => $formHelper->getFieldValue($surname, 'Enter your Surname'),
    'options' => array('error' => $formHelper->getFieldError($surname))
);

$dob = E_TABLE.SEP.E_DOB;
$dob = array(
    'type' => 'text',
    'label' => 'Date of birth',
    'name' => $dob,
    'value' => $formHelper->getFieldValue($dob, 'Click here to get calendar'),
    'options' => array('error' => $formHelper->getFieldError($dob))
);

$email = E_TABLE.SEP.E_EMAIL;
$email = array(
    'type' => 'text',
    'label' => 'Email',
    'name' => $email,
    'value' => $formHelper->getFieldValue($email, 'Enter you email'),
    'options' => array('error' => $formHelper->getFieldError($email))
);

$phone = E_TABLE.SEP.E_PHONE_NUMBER;
$phone = array(
    'type' => 'text',
    'label' => 'Phone Number',
    'name' => $phone,
    'value' => $formHelper->getFieldValue($phone, 'Enter you phone number'),
    'options' => array('error' => $formHelper->getFieldError($phone))
);

$position = EMPL_TABLE.SEP.EMPL_POSITION;
$position = array(
    'type' => 'select',
    'label' => 'Position',
    'name' => $position,
    'value' => array('values' => $positionList, 'selected' => $formHelper->getFieldValue($position)),
    'options' => array('error' => $formHelper->getFieldError($position))
);

$brand = EMPL_TABLE.SEP.EMPL_BRAND;
$brand = array(
    'type' => 'select',
    'label' => 'Brand',
    'name' => $brand,
    'value' => array('values' => $brandList, 'selected' => $formHelper->getFieldValue($brand)),
    'options' => array('error' => $formHelper->getFieldError($brand))
);

$department = EMPL_TABLE.SEP.EMPL_DEPARTMENT;
$department = array(
    'type' => 'select',
    'label' => 'Department',
    'name' => $department,
    'value' => array('values' => $departmentList, 'selected' => $formHelper->getFieldValue($department)),
    'options' => array('error' => $formHelper->getFieldError($department))
);

$location = EMPL_TABLE.SEP.EMPL_LOCATION;
$location = array(
    'type' => 'select',
    'label' => 'Location',
    'name' => $location,
    'value' => array('values' => $locationList, 'selected' => $formHelper->getFieldValue($location)),
    'options' => array('error' => $formHelper->getFieldError($location))
);

$parent = E_TABLE.SEP.E_PARENT;
$parent = array(
    'type' => 'select',
    'label' => 'Superior',
    'name' => $parent,
    'value' => array('values' => array(), 'selected' => $formHelper->getFieldValue($parent)),
    'options' => array('error' => $formHelper->getFieldError($parent))
);

// address
$street = OA_TABLE.SEP.OA_STREET;
$street = array(
    'type' => 'text',
    'label' => 'House number & Street',
    'name' => $street,
    'value' => $formHelper->getFieldValue($street, 'Enter Street'),
    'options' => array('error' => $formHelper->getFieldError($street))
);

$postcode = OA_TABLE.SEP.OA_POSTCODE;
$postcode = array(
    'type' => 'text',
    'label' => 'Postcode',
    'name' => $postcode,
    'value' => $formHelper->getFieldValue($postcode, 'Enter Postcode'),
    'options' => array('error' => $formHelper->getFieldError($postcode))
);

$city = OA_TABLE.SEP.OA_CITY;
$city = array(
    'type' => 'text',
    'label' => 'City',
    'name' => $city,
    'value' => $formHelper->getFieldValue($city, 'Enter City'),
    'options' => array('error' => $formHelper->getFieldError($city))
);

$county = OA_TABLE.SEP.OA_COUNTY;
$county = array(
    'type' => 'text',
    'label' => 'County',
    'name' => $county,
    'value' => $formHelper->getFieldValue($county, 'Enter County'),
    'options' => array('error' => $formHelper->getFieldError($county))
);

$createAccountFormItems = array(
    'Personal Information' => array(
        $name,
        $surname,
        $dob,
        $email,
        $phone
    ),
    'Employment Information' => array(
        $position,
        $brand,
        $department,
        $location,
        $parent,
        '' => array(
            $street,
            $postcode,
            $city,
            $county
        )
    )
);

// change names of fields for previous employment section
$position['name'] = PREV_PREFIX.EMPL_TABLE.SEP.EMPL_POSITION;
$brand['name'] = PREV_PREFIX.EMPL_TABLE.SEP.EMPL_BRAND;
$department['name'] = PREV_PREFIX.EMPL_TABLE.SEP.EMPL_DEPARTMENT;
$location['name'] = PREV_PREFIX.EMPL_TABLE.SEP.EMPL_LOCATION;

$street['name'] = PREV_PREFIX.OA_TABLE.SEP.OA_STREET;
$postcode['name'] = PREV_PREFIX.OA_TABLE.SEP.OA_POSTCODE;
$city['name'] = PREV_PREFIX.OA_TABLE.SEP.OA_CITY;
$county['name'] = PREV_PREFIX.OA_TABLE.SEP.OA_COUNTY;

$prevEmplSelect = array(
    $position,
    $brand,
    $department,
    $location
);

$prevEmplAddress = array(
    $street,
    $postcode,
    $city,
    $county
);

$formGen = new FormGenerator('create_account', $employee->getProperty('createScriptPath'), 'post');

// add multiple option to fields
$formGen->setOptionToElements($prevEmplSelect, 'multiple', TRUE);
$formGen->setOptionToElements($prevEmplAddress, 'multiple', TRUE);

die(var_dump($prevEmplAddress));

$HTMLBlock = <<< HTML
<div id="previous-employment">
<h2>Previous Employment</h2>
<button type="button" id="add-previous-options">Add</button>
<div class="add-block" >
HTML;
if(isset($_SESSION['user']['inputs']['prev_empl'])){
    for($i=0; $i < count($_SESSION['user']['inputs']['prev_empl']); $i++){
        $inputErrors = (isset($_SESSION['user']['errors']['prev_empl'][$i]))? $_SESSION['user']['errors']['prev_empl'][$i]: array();
        $userInputs = (isset($_SESSION['user']['inputs']['prev_empl'][$i]))? $_SESSION['user']['inputs']['prev_empl'][$i]: array();

        $formHelper = new FormHelper($userInputs, $inputErrors);

        $prevEmplSelect = $formHelper->setValuesForElements($prevEmplSelect);
        $prevEmplSelect = $formHelper->setValuesForElements($prevEmplSelect);

        $prevEmplAddress = $formHelper->setValuesForElements($prevEmplAddress);
        $prevEmplAddress = $formHelper->setValuesForElements($prevEmplAddress);

        $prevEmplSelect = $formGen->createElements($prevEmplSelect);
        $HTMLBlock .= $formGen->renderElements($prevEmplSelect, 'list');
        $prevEmplAddress = $formGen->createElements($prevEmplAddress, 'Office Address');
        $HTMLBlock .= $formGen->renderElements($prevEmplAddress, 'div');
    }
}

$HTMLBlock .= <<< HTML
    </div>
</div>
HTML;



$formGen->addElements($createAccountFormItems);
$formGen->addHTMLBlock($HTMLBlock);
echo $formGen->render('list');

?>

<div class="new-block hide original" >
    <?php
        if (!isset($hide)){
            $prevEmplSelect = $formGen->createElements($prevEmplSelect);
            echo $formGen->renderElements($prevEmplSelect, 'div');
            $prevEmplAddress = $formGen->createElements($prevEmplAddress, 'Office Address');
            echo $formGen->renderElements($prevEmplAddress, 'div');

        }
    ?>
</div>
<?php
//clear session
unset($_SESSION['user']['errors']);
unset($_SESSION['user']['inputs']);

?>