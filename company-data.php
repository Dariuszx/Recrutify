<?php

include('src/session.php');

include_once 'src/tools.php';

$database = new Database();
$data = new UserData();

if ($database->getUserRole($_SESSION['user_id']) == 0) {
    header("Location: profile.php");
}

$company_data = $database->getCompanyData($_SESSION['user_id']);

if (isset($_POST['submit'])) {

    $name = $_POST['inputName'];
    $description = $_POST['inputDescription'];
    $nip = $_POST['inputNip'];
    $regon = $_POST['inputRegon'];
    $city = $_POST['inputCity'];
    $street = $_POST['inputStreet'];
    $postal_code = $_POST['inputPostalCode'];
    $phone_number = $_POST['inputPhone'];

    $data->validateInputData($name);
    $data->validateInputData($description);
    $data->validateInputData($regon);
    $data->validateInputData($city);
    $data->validateInputData($street);
    $data->validateInputData($postal_code);
    $data->validateInputData($phone_number);

    if (!is_object($company_data)) {
        $query = "INSERT INTO companies (employer_id, name, description, nip, regon, city, street, postal_code, phone) 
                  VALUES (" . $_SESSION['user_id'] . ", '" . $name . "', '" . $description . "', '" . $nip . "', '" . $regon . "', '" . $city . "', '" . $street . "', '" . $postal_code . "', '" . $phone_number . "')";
    } else {
        $query = "UPDATE companies 
                  SET 
                    name = '" . $name . "', 
                    description = '" . $description . "', 
                    nip = '" . $nip . "', 
                    regon = '" . $regon . "', 
                    city = '" . $city . "', 
                    street = '" . $street . "', 
                    postal_code = '" . $postal_code . "', 
                    phone = '" . $phone_number . "' 
                  WHERE employer_id = " . $_SESSION['user_id'];
    }

    if (isset($query)) {
        $database->executeSql($query);
        $company_data = $database->getCompanyData($_SESSION['user_id']);
    }
}


include "src/templates/profile/header.html";

?>

<div class="container wrapper">

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Dane firmy</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-8 col-md-offset-2 well bs-component">
                    <form class="form-horizontal" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputName" class="col-lg-4 control-label">Nazwa firmy</label>
                                <div class="col-lg-8">
                                    <input value="<?php if ($company_data) echo $company_data->name; ?>" type="text"
                                           class="form-control" id="inputName" name="inputName"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-lg-4 control-label">Opis</label>
                                <div class="col-lg-8">
                                    <textarea rows="3" class="form-control" id="inputDescription"
                                              name="inputDescription"><?php if ($company_data) echo $company_data->description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputNip" class="col-lg-4 control-label">NIP</label>
                                <div class="col-lg-4">
                                    <input value="<?php if ($company_data) echo $company_data->nip; ?>" type="text"
                                           class="form-control" id="inputNip" name="inputNip"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRegon" class="col-lg-4 control-label">REGON</label>
                                <div class="col-lg-4">
                                    <input value="<?php if ($company_data) echo $company_data->regon; ?>" type="text"
                                           class="form-control" id="inputRegon" name="inputRegon"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCity" class="col-lg-4 control-label">Miasto</label>
                                <div class="col-lg-8">
                                    <input value="<?php if ($company_data) echo $company_data->city; ?>" type="text"
                                           class="form-control" id="inputCity" name="inputCity"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStreet" class="col-lg-4 control-label">Ulica</label>
                                <div class="col-lg-8">
                                    <input value="<?php if ($company_data) echo $company_data->street; ?>" type="text"
                                           class="form-control" id="inputStreet" name="inputStreet"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPostalCode" class="col-lg-4 control-label">Kod pocztowy</label>
                                <div class="col-lg-4">
                                    <input value="<?php if ($company_data) echo $company_data->postal_code; ?>"
                                           type="text"
                                           class="form-control" id="inputPostalCode" name="inputPostalCode"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-lg-4 control-label">Numer telefonu</label>
                                <div class="col-lg-4">
                                    <input value="<?php if ($company_data) echo $company_data->phone; ?>" type="text"
                                           class="form-control" id="inputPhone" name="inputPhone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-2 col-lg-offset-8">
                                    <button type="submit" name="submit" class="btn btn-success">Aktualizuj dane</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<?php

include_once "src/templates/commons/footer.html";

?>
