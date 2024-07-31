<?php
require_once 'db.php'; // Assurez-vous que ce fichier contient les informations de connexion à la base de données
require_once 'translate.php';

// Récupérer les agences de location de voiture de la base de données
$query = "SELECT id, name FROM car_rental_agencies"; // Remplacez par le nom correct de votre table
$stmt = $conn->prepare($query);
$stmt->execute();
$agencies = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo __("car_rental"); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h1 class="text-center my-4"><?php echo __("car_rental"); ?></h1>
    
    <!-- Formulaire de recherche de location de voiture -->
    <form action="car_rental_search.php" method="GET" class="form-container mx-auto mb-4" style="max-width: 900px;">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pickup_location"><?php echo __("pick_up_location"); ?>:</label>
                <input type="text" class="form-control" id="pickup_location" name="pickup_location" placeholder="<?php echo __('enter_city_or_airport'); ?>" required>
            </div>
            <div class="form-group col-md-2">
                <label for="pickup_date"><?php echo __("pick_up_date"); ?>:</label>
                <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
            </div>
            <div class="form-group col-md-2">
                <label for="dropoff_date"><?php echo __("drop_off_date"); ?>:</label>
                <input type="date" class="form-control" id="dropoff_date" name="dropoff_date" required>
            </div>
            <div class="form-group col-md-3">
                <label for="rental_agency"><?php echo __("rental_agency"); ?>:</label>
                <select class="form-control" id="rental_agency" name="rental_agency">
                    <option value=""><?php echo __("select_agency"); ?></option>
                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?php echo $agency['id']; ?>"><?php echo $agency['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary btn-block"><?php echo __("search"); ?></button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/avis.png" alt="Avis">
                <div class="card-body">
                    <h5 class="card-title">Avis</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_avis_car_rentals"); ?></p>
                    <a href="https://www.avis.com" class="btn btn-primary" target="_blank"><?php echo __("visit_avis"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/hertz.png" alt="Hertz">
                <div class="card-body">
                    <h5 class="card-title">Hertz</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_hertz_car_rentals"); ?></p>
                    <a href="https://www.hertz.com" class="btn btn-primary" target="_blank"><?php echo __("visit_hertz"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/enterprise.png" alt="Enterprise">
                <div class="card-body">
                    <h5 class="card-title">Enterprise</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_enterprise_car_rentals"); ?></p>
                    <a href="https://www.enterprise.com" class="btn btn-primary" target="_blank"><?php echo __("visit_enterprise"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/sixt.png" alt="Sixt">
                <div class="card-body">
                    <h5 class="card-title">Sixt</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_sixt_car_rentals"); ?></p>
                    <a href="https://www.sixt.com" class="btn btn-primary" target="_blank"><?php echo __("visit_sixt"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/budget.png" alt="Budget">
                <div class="card-body">
                    <h5 class="card-title">Budget</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_budget_car_rentals"); ?></p>
                    <a href="https://www.budget.com" class="btn btn-primary" target="_blank"><?php echo __("visit_budget"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/alamo.png" alt="Alamo">
                <div class="card-body">
                    <h5 class="card-title">Alamo</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_alamo_car_rentals"); ?></p>
                    <a href="https://www.alamo.com" class="btn btn-primary" target="_blank"><?php echo __("visit_alamo"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/thrifty.png" alt="Thrifty">
                <div class="card-body">
                    <h5 class="card-title">Thrifty</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_thrifty_car_rentals"); ?></p>
                    <a href="https://www.thrifty.com" class="btn btn-primary" target="_blank"><?php echo __("visit_thrifty"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/national.png" alt="National">
                <div class="card-body">
                    <h5 class="card-title">National</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_national_car_rentals"); ?></p>
                    <a href="https://www.nationalcar.com" class="btn btn-primary" target="_blank"><?php echo __("visit_national"); ?></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="images/europcar.png" alt="Europcar">
                <div class="card-body">
                    <h5 class="card-title">Europcar</h5>
                    <p class="card-text"><?php echo __("find_great_deals_on_europcar_car_rentals"); ?></p>
                    <a href="https://www.europcar.com" class="btn btn-primary" target="_blank"><?php echo __("visit_europcar"); ?></a>
                </div>
            </div>
        </div>
       
    </div>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>