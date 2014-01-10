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

$formHelper = new FormHelper($inputErrors, $userInputs);

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
    'label' => 'Phone Number',
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
    'name' => $location,
    'value' => array('values' => array(), 'selected' => $formHelper->getFieldValue($parent)),
    'options' => array('error' => $formHelper->getFieldError($parent))
);

// address
$street = OA_TABLE.SEP.OA_STREET;
$street = array(
    'type' => 'text',
    'label' => 'House number & Street',
    'name' => $phone,
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
        $location,
        $parent,
        'Office Address' => array(
            $street,
            $postcode,
            $city,
            $county
        )
    )
);

$formGen = new FormGenerator('create_account', '../scripts/create_account.php', 'post');
$formElements = array();
foreach ($createAccountFormItems as $group => $element) {
    $formElements[$group] = $formGen->createElement($element['type'], $element['label'], $element['name'], $element['value'], $element['options']);

}
$formGen->addGroupElements($group, $element);

$name = $formGen->createElement('text', 'Name', $name,  get_field_value($name, $userInputs,'Enter you name '), array('error' => get_field_error($name, $inputErrors)));
$surname = $formGen->createElement('text', 'Surname', $surname,  get_field_value($surname, $userInputs,'Enter you surname '), array(
    'error' => get_field_error($surname, $inputErrors)
));

$formGen->addGroupElements('Personal Information', array($name, $surname));
echo $formGen->render('div');

//die();

?>

<form action="../scripts/create_account.php" method="post" name="create-account" id="create-account"
      accept-charset="utf-8" xmlns="http://www.w3.org/1999/html">
  <div class="form-all">
    <fieldset>
        <label>Personal Information</label>
        <ul class="form-section">
          <li class="form-line">
            <label for="name"> Name </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_NAME, $inputErrors) ?></div>
            <div class="form-input">
              <input type="text" id="name" name="<?= E_TABLE.SEP.E_NAME?>" size="40" value="<?= get_field_value(E_TABLE.SEP.E_NAME, $userInputs,'Enter you name ') ?>" />
            </div>
          </li>
          <li class="form-line">
            <label for="surname"> Surname </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_SURNAME, $inputErrors) ?></div>
            <div class="form-input">
              <input type="text" id="surname" name=<?= E_TABLE.SEP.E_SURNAME ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_SURNAME, $userInputs, 'Enter you surname ') ?>" />
            </div>
          </li>
          <li class="form-line" >
            <label class="form-label-left" for="dob"> Date of Birth </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_DOB, $inputErrors) ?></div>
            <div id="cid_5" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="dob" name=<?= E_TABLE.SEP.E_DOB ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_DOB, $userInputs, 'click here to see calendar') ?>"/>
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" for="email"> Email </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_EMAIL, $inputErrors) ?></div>
            <div id="cid_7" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="email" name=<?= E_TABLE.SEP.E_EMAIL ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_EMAIL, $userInputs, 'Enter you email') ?>"  />
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" for="phone"> Tel. Number </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_PHONE_NUMBER, $inputErrors) ?></div>
            <div id="cid_6" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="phone" name=<?= E_TABLE.SEP.E_PHONE_NUMBER ?> size="40" value="<?= get_field_value(E_TABLE.SEP.E_PHONE_NUMBER, $userInputs, 'Enter you phone number') ?>"  />
            </div>
          </li>
          <li class="form-line">
            <label class="form-label-left" id="label_8" for="position"> Job Title </label>
              <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_POSITION, $inputErrors) ?></div>
            <div id="cid_8" class="form-input">
              <select class="form-dropdown" style="width:150px" id="position" name="<?= EMPL_TABLE.SEP.EMPL_POSITION ?>">
                  <?= $htmlGen->renderSelectOptions($positionList, get_field_value(EMPL_TABLE.SEP.EMPL_POSITION, $userInputs))?>
              </select>
            </div>
          </li>
          <li class="form-line" id="id_9">
            <label class="form-label-left" id="label_9" for="brand"> Brand </label>
              <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_BRAND, $inputErrors) ?></div>
            <div id="cid_9" class="form-input">
              <select class="form-dropdown" style="width:150px" id="brand" name="<?= EMPL_TABLE.SEP.EMPL_BRAND ?>">
                  <?= $htmlGen->renderSelectOptions($brandList, get_field_value(EMPL_TABLE.SEP.EMPL_BRAND, $userInputs))?>
              </select>
            </div>
          </li>
          <li class="form-line" id="id_10">
            <label class="form-label-left" id="label_10" for="department"> Department </label>
            <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_DEPARTMENT, $inputErrors) ?></div>
            <div id="cid_10" class="form-input">
              <select class="form-dropdown" style="width:150px" id="department" name="<?= EMPL_TABLE.SEP.EMPL_DEPARTMENT ?>">
                  <?= $htmlGen->renderSelectOptions($departmentList, get_field_value(EMPL_TABLE.SEP.EMPL_DEPARTMENT, $userInputs))?>
              </select>
            </div>
          </li>
            <li class="form-line">
                <label for="location"> Location </label>
                <div class="error"><?=  get_field_error(EMPL_TABLE.SEP.EMPL_LOCATION, $inputErrors) ?></div>
                <div id="cid_10" class="form-input">
                    <select class="form-dropdown" style="width:150px" id="location" name="<?= EMPL_TABLE.SEP.EMPL_LOCATION ?>">
                        <?= $htmlGen->renderSelectOptions($locationList, get_field_value(EMPL_TABLE.SEP.EMPL_LOCATION, $userInputs))?>
                    </select>
                </div>
            </li>
          <li class="form-line" id="id_11">
            <label class="form-label-left" id="label_11" for="superior"> Superior </label>
              <div class="error"><?=  get_field_error(E_TABLE.SEP.E_PARENT, $inputErrors) ?></div>
              <select class="form-dropdown" style="width:150px" id="location" name="<?= E_TABLE.SEP.E_PARENT ?>">
                  <?= $htmlGen->renderSelectOptions($superiorList, get_field_value(E_TABLE.SEP.E_PARENT, $userInputs))?>
              </select>
          </li>
        </ul>
        </fieldset>
  </div>
  <div>
    <fieldset>
      <legend>Office Address</legend>
        <ul>
          <li class="form-line" id="id_13">
            <label class="form-label-left" id="label_13" for="street"> House number & Street </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_STREET, $inputErrors) ?></div>
            <div id="cid_13" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="street" name="<?= OA_TABLE.SEP.OA_STREET ?>" size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_STREET, $userInputs, 'Enter your house number and street') ?>" />
            </div>
          </li>
          <li class="form-line" id="id_14">
            <label class="form-label-left" id="label_14" for="postcode"> Postcode </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_POSTCODE, $inputErrors) ?></div>
            <div id="cid_14" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="postcode" name="<?= OA_TABLE.SEP.OA_POSTCODE ?>" size="20" value="<?= get_field_value(OA_TABLE.SEP.OA_POSTCODE, $userInputs, 'Enter postcode')?>" maxlength="12" />
            </div>
          </li>
          <li class="form-line" id="id_15">
            <label class="form-label-left" id="label_15" for="city"> City </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_CITY, $inputErrors) ?></div>
            <div id="cid_15" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="city" name="<?= OA_TABLE.SEP.OA_CITY ?>" size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_CITY, $userInputs, 'Enter city')?>" />
            </div>
          </li>
          <li class="form-line" id="id_16">
            <label class="form-label-left" id="label_16" for="county"> County </label>
            <div class="error"><?=  get_field_error(OA_TABLE.SEP.OA_COUNTY, $inputErrors) ?></div>
            <div id="cid_16" class="form-input">
              <input type="text" class=" form-textbox" data-type="input-textbox" id="county" name="<?= OA_TABLE.SEP.OA_COUNTY ?>" size="40" value="<?= get_field_value(OA_TABLE.SEP.OA_COUNTY, $userInputs, 'Enter county')?>" />
            </div>
          </li>
        </ul>
    </fieldset>
  </div>
    Previous Employment
    <button type="button" id="add-previous-options">Add</button>
    <div id="previous-employment">
        <div class="add-block" >
            <?php
                if(isset($_SESSION['user']['inputs']['prev_empl'])){
                    $hide = FALSE;
                    for($i=0; $i < count($_SESSION['user']['inputs']['prev_empl']); $i++){
                        $inputErrors = (isset($_SESSION['user']['errors']['prev_empl'][$i]))? $_SESSION['user']['errors']['prev_empl'][$i]: array();
                        $userInputs = (isset($_SESSION['user']['inputs']['prev_empl'][$i]))? $_SESSION['user']['inputs']['prev_empl'][$i]: array();
                        include(FORMS.'/employee/create_account_prev_empl.php');
                    }
                }
            ?>
        </div>
    </div>
    <div class="form-input-wide">
     <div style="margin-left:156px" class="form-buttons-wrapper">
         <button id="input_2" type="submit" class="form-submit-button">Submit</button>
     </div>
  </div>
</form>
<?php
if (!isset($hide)){
    $hide = TRUE;
    include_once(FORMS.'/employee/create_account_prev_empl.php');
}
//clear session
unset($_SESSION['user']['errors']);
unset($_SESSION['user']['inputs']);

?>