<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
$mysql_address = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_db = "property_tax";
$debug = true;
$conn = new mysqli($mysql_address, $mysql_user, $mysql_password, $mysql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function register()
{
    global $conn;

    $regFailed = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning !</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>You're already registered.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        HTML;

    $regSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Registered Successfully.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        HTML;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $user_id = $_SESSION["user_id"];

        $sql = "INSERT INTO property_owner (account_id, first_name, last_name, email, contact_no) VALUES ( ?, ?, ?, ?, ?)";
        $stored_id = "SELECT * FROM property_owner WHERE account_id = '$user_id'";
        $result = $conn->query($stored_id);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $fname, $lname, $email, $contact);

        if ($result) {
            if ($result->num_rows > 0) {
                echo $regFailed;
            } else {
                if ($stmt->execute()) {
                    echo $regSuccess;
                    recordTransaction($user_id, "Account Registration");
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    }
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);</script>';
}

function submitProperty()
{
    $submitted = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Property Registered Successfully.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
        HTML;

    $failed = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">WARNING!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>This address is already registered to another property.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
        HTML;


    global $conn;
    $user_id = $_SESSION["user_id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $houseNo = $_POST['houseNo'];
        $street = $_POST['street'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $fullAddress = $houseNo . ', ' . $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
        $formatVal = (int)$_POST['propertyValue'];
        $value = number_format($formatVal);
        $propertyType = $_POST['listGroupRadio'];

        $sqlfindAddress = "SELECT * FROM property WHERE property_address = ?";
        $stmtFindAdd = $conn->prepare($sqlfindAddress);
        $stmtFindAdd->bind_param("s", $fullAddress);

        if ($stmtFindAdd->execute()) {
            $result = $stmtFindAdd->get_result();
            if ($result->num_rows > 0) {
                echo $failed;
            } else {
                $sql = "INSERT INTO property (account_id, property_address, value, property_type) VALUES (?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sql);
                $stmtInsert->bind_param("isss", $user_id, $fullAddress, $value, $propertyType);

                if ($stmtInsert->execute()) {
                    // gets the property id
                    $sqlGetProperty_Id = "SELECT property_id FROM property WHERE property_address = ?";
                    $stmtGetProperty = $conn->prepare($sqlGetProperty_Id);
                    $stmtGetProperty->bind_param("s", $fullAddress);

                    if ($stmtGetProperty->execute()) {
                        $result = $stmtGetProperty->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $propertyId = $row['property_id'];
                            }
                        } else {
                            echo "No property found for address: $fullAddress";
                        }
                    } else {
                        echo "Error: " . $stmtGetProperty->error;
                    }
                    $stmtGetProperty->free_result();
                    $stmtGetProperty->close();
                    // gets the owner id
                    $sqlGetOwnerId = "SELECT owner_id FROM property_owner WHERE account_id = ?";
                    $stmtGetOwnerId = $conn->prepare($sqlGetOwnerId);
                    $stmtGetOwnerId->bind_param("i", $user_id);

                    if ($stmtGetOwnerId->execute()) {
                        $resultOwnerId = $stmtGetOwnerId->get_result();

                        if ($resultOwnerId->num_rows > 0) {
                            while ($rowOwner = $resultOwnerId->fetch_assoc()) {
                                $owner_id = $rowOwner['owner_id'];
                            }
                        }
                    } else {
                        echo "Error retrieving owner_id: " . $stmtGetOwnerId->error;
                    }
                    $stmtGetOwnerId->free_result();
                    $stmtGetOwnerId->close();

                    setTax($formatVal, $propertyType, $propertyId, $owner_id);

                    echo $submitted;
                } else {
                    echo "Error: " . $stmtInsert->error;
                }
                $stmtInsert->close();
                recordTransaction($user_id, "Property Registration");
            }
        } else {
            echo "Error: " . $stmtFindAdd->error;
        }
        $stmtFindAdd->close();
    }
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function viewTax()
{
    global $conn;

    $failed = <<<HTML

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Incorrect inputs.</code></p>
                        <p>Please check your inputs.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
    HTML;

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $user_id = $_SESSION["user_id"];
    $houseNo = $_POST['houseNo'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $address = $houseNo . ', ' . $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
    $propertyType = $_POST['listGroupRadio'];
    $validate = false;
    $userMatch = false;
    $propertyMatch = false;
    $valFname = "";
    $valLname = "";
    $valAddress = "";
    $valType = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $findUser = "SELECT * FROM property_owner WHERE account_id = ?";
        $stmt = $conn->prepare($findUser);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $valFname = $row['first_name'];
            $valLname = $row['last_name'];
            $valOwnerId = $row['owner_id'];
        }
        if ($valFname === $fname && $valLname === $lname) {
            $userMatch = true;
        }

        $findProperty = "SELECT * FROM property WHERE account_id = ? AND property_address = ? AND property_type = ?";
        $stmt = $conn->prepare($findProperty);
        $stmt->bind_param("iss", $user_id, $address, $propertyType);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $valAddress = $row['property_address'];
            $valType = $row['property_type'];
            $valPropertyId = $row['property_id'];
        }
        if ($valAddress === $address && $valType === $propertyType) {
            $propertyMatch = true;
        }

        if ($userMatch === true && $propertyMatch === true) {
            $validate = true;
        }

        if ($validate === true) {
            $modals = '';
            $getTax = "SELECT * FROM tax_record WHERE account_id = ? AND property_id = ? AND owner_id = ?";
            $stmt = $conn->prepare($getTax);
            $stmt->bind_param("iss", $user_id, $valPropertyId, $valOwnerId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $taxId = $row['tax_id'];
                    $accountId = $row['account_id'];
                    $propertyId = $row['property_id'];
                    $ownerId = $row['owner_id'];
                    $taxAmount = $row['tax_amount'];
                    $paymentStatus = $row['payment_status'];
                    $taxRate = $row['tax_rate'];

                    $modalContent = <<<HTML
                     <div class="modal fade" id="taxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="taxModalLabel">Tax Information</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Tax ID:</strong></p>
                                            <p><strong>Account ID:</strong></p>
                                            <p><strong>Property ID:</strong></p>
                                            <p><strong>Owner ID:</strong></p>
                                            <p><strong>Tax Amount:</strong></p>
                                            <p><strong>Payment Status:</strong></p>
                                            <p><strong>Tax Rate:</strong></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>$taxId</p>
                                            <p>$accountId</p>
                                            <p>$propertyId</p>
                                            <p>$ownerId</p>
                                            <p>$taxAmount</p>
                                            <p>$paymentStatus</p>
                                            <p>$taxRate</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <p><code>Press anywhere to exit.</code></p>
                                </div>
                            </div>
                        </div>
                        </div>
                        <script>
                        $(document).ready(function(){
                            $('#taxModal').modal('show');
                        });
                        </script>
                    HTML;
                

                    $modals .= $modalContent;
                    echo $modals;
                }
            } else {
                echo "No rows found";
            }
            recordTransaction($user_id, "Tax Viewing");
        } else {

            echo $failed;
        }

        $stmt->close();
        $conn->close();
    }
}

function setTax($value, $type, $id, $owner_id)
{
    global $conn;

    switch ($type) {
        case "Single-Family Home":
        case "Condominium":
            $taxRate = 0.01;
            break;
        case "Apartment":
        case "Townhouse":
        case "Mobile/Manufactured Home":
            $taxRate = 0.013;
            break;
        case "Duplex/Triplex":
            $taxRate = 0.015;
            break;
        case "Vacant Land":
            $taxRate = 0.008;
            break;
        case "Commercial Property":
            $taxRate = 0.02;
            break;
        default:

            break;
    }

    if ($taxRate > 0) {
        $taxAmount = $value * $taxRate;
        $user_id = $_SESSION["user_id"];
        $percentageTax = $taxRate * 100;
        $rate = $percentageTax . '%';
        $payment_status = "Unpaid";

        $sql = "INSERT INTO tax_record (account_id, property_id, owner_id, tax_amount, payment_status, tax_rate) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiiss", $user_id, $id, $owner_id, $taxAmount, $payment_status, $rate);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Tax Rate for the given property type not found.";
    }
}

function getTables($tableName, $function)
{
    global $conn;

    $sql = "SELECT * FROM $tableName";

    $result = $conn->query($sql);

    switch ($tableName) {

        case "property_owner":
            if ($result->num_rows > 0) {

                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Owner Id</th><th>Account Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact No.</th></tr></thead>';

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["owner_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["contact_no"] . '</td></tr></tbody>';
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            break;

        case "property":
            if ($result->num_rows > 0) {

                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Property Id</th><th>Account Id</th><th>Property Address</th><th>Value</th><th>Property Type</th></tr></thead>';

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["property_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["property_address"] . '</td><td>' . $row["value"] . '</td><td>' . $row["property_type"] . '</td></tr></tbody>';
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            break;

        case "tax_record":

            $notFound = <<<HTML
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Warning !</h5>
                        </div>
                        <div class="modal-body text-center">
                            <p style="font-size: 25px;"><code>Id not found.</code></p>
                            <p>Press anywhere to continue.</p>
                        </div>
                    </div>
                </div>
                </div>
            
                <!-- Script to show the modal -->
                <script>
                $(document).ready(function(){
                    $('#myModal').modal('show');
                });
                </script>
            HTML;

            switch ($function) {

                case "manage":

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findBtn'])) {

                        $taxId = $_POST['find'];
                        $getTaxRow = "SELECT * FROM $tableName WHERE tax_id = $taxId";

                        $resultSet = $conn->query($getTaxRow);

                        if ($resultSet) {
                            if ($resultSet->num_rows > 0) {
                                // Fetch the ID from the result set
                                $row = $resultSet->fetch_assoc();
                                echo '<h2 class="text-center mb-4 mt-4">Tax Payment</h2>';
                                echo '<div class="container">';
                                echo '<table class="table table-hover " style="text-align:center;">';
                                echo '<thead  class="table-light"><tr><th>Tax Id</th><th>Account Id</th><th>Property Id</th><th>Owner Id</th><th>Tax Amount</th></th><th>Payment Status</th><th>Tax Rate</th></tr></thead>';

                                // Display the first row
                                echo '<tbody class="table-dark"><tr><td>' . $row["tax_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["property_id"] . '</td><td>' . $row["owner_id"] . '</td><td>' . $row["tax_amount"] . '</td><td>' . $row["payment_status"] . '</td><td>' . $row["tax_rate"] . '</td></tr></tbody>';
                                $_SESSION['tax_id'] = $row["tax_id"];

                                // Output data of the rest of the rows
                                while ($rowDisplay = $resultSet->fetch_assoc()) {

                                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["tax_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["property_id"] . '</td><td>' . $rowDisplay["owner_id"] . '</td><td>' . $rowDisplay["tax_amount"] . '</td><td>' . $rowDisplay["payment_status"] . '</td><td>' . $rowDisplay["tax_rate"] . '</td></tr></tbody>';
                                }
                                echo "</table>";
                                echo '<form method="POST">';
                                echo '<div class="row m-5">';
                                echo '<div class="col p-0">';
                                echo '<label for="numberInput"><h3><code class="m-4">Enter Payment</code></h3></label>';
                                echo '<input type="number" class="col-4" name="payment" placeholder=" $ Payment">';
                                echo '</div>';
                                echo '</div>';
                                echo '<div class="row mt-2">';
                                echo '<div class="col p-0">';
                                echo '<button class="btn btn-primary shadow px-4" name="paymentBtn" id="paymentBtn" type="submit">Submit Payment</button>';
                                echo '</div>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                            } else {
                                echo $notFound;
                                echo "No results found for '$taxId'";
                            }
                        } else {
                            echo "Error executing the query: " . $conn->error;
                        }
                    }
                    break;

                case 'display':
                    if ($result->num_rows > 0) {

                        echo '<table class="table table-hover " style="text-align:center;">';
                        echo '<thead  class="table-light"><tr><th>Tax Id</th><th>Account Id</th><th>Property Id</th><th>Owner Id</th><th>Tax Amount</th></th><th>Payment Status</th><th>Tax Rate</th></tr></thead>';

                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<tbody class="table-dark"><tr><td>' . $row["tax_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["property_id"] . '</td><td>' . $row["owner_id"] . '</td><td>' . $row["tax_amount"] . '</td><td>' . $row["payment_status"] . '</td><td>' . $row["tax_rate"] . '</td></tr></tbody>';
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    break;
            }

            break;
        case "transactions":
            if ($result->num_rows > 0) {

                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Transaction Id</th><th>Account Id</th><th>Transaction Type</th><th>Transaction Date</th></tr></thead>';

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["transaction_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["transaction_type"] . '</td><td>' . $row["transaction_date"] . '</td></tr></tbody>';
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            break;   
        default:
            break;
    }
}

function payTax()
{
    $paymentExact = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Thank you for paying the exact amount.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
    HTML;

    $paymentFailed = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Not Enough Payment.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
    HTML;

    global $conn;
    $paymentcompleted = false;
    $taxId = $_SESSION['tax_id'];
    $user_id = $_SESSION['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentBtn'])) {
        $payment = intval($_POST['payment']);

        $sql = "SELECT * FROM tax_record WHERE tax_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $taxId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $taxAmount = $row['tax_amount'];
        }

        $calculateTax = $payment - $taxAmount;

        $paymentChange = <<<HTML
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p>Thank You. </p>
                        <p style = "font-size: 25px;"><code>Your change is: PHP $calculateTax</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
            </div>
            <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
            </script>
        HTML;

        if ($calculateTax > 0) {
            echo $paymentChange;
            $paymentcompleted = true;
        } else if ($calculateTax == 0) {
            echo $paymentExact;
            $paymentcompleted = true;
        } else {
            echo $paymentFailed;
            $paymentcompleted = false;
        }

        if ($paymentcompleted === true) {
            $newStatus = "Paid";
            $sql = "UPDATE tax_record SET payment_status = ? WHERE tax_id = ?";
            $stmtUpdate = $conn->prepare($sql);
            $stmtUpdate->bind_param("si", $newStatus, $taxId);
            $stmtUpdate->execute();
            recordTransaction($user_id, "Tax Payment");
        }
        $stmtUpdate->close();
    }
    $stmt->close();
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);</script>';
}

function printModOwner()
{
    global $conn;

    $ownerNotFound = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning !</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Id not found.</code></p>
                    <p>Press anywhere to continue.</p>
                </div>
            </div>
        </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
        </script>
    HTML;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findOwnerBtn'])) {

        $ownerId = $_POST['find'];
        $getOwnerRow = "SELECT * FROM property_owner WHERE owner_id = $ownerId";

        $_SESSION['owner_id'] = $ownerId;

        $resultSet = $conn->query($getOwnerRow);

        if ($resultSet) {
            if ($resultSet->num_rows > 0) {
                $row = $resultSet->fetch_assoc();

                echo '<h3><code>Record Selected.</code> </h3>';
                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Owner Id</th><th>Account Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact No.</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["owner_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["contact_no"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["owner_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["first_name"] . '</td><td>' . $rowDisplay["last_name"] . '</td><td>' . $rowDisplay["email"] . '</td><td>' . $rowDisplay["contact_no"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyOwnerModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4" name="deleteOwnerBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
                echo '</form>';
            } else {
                echo $ownerNotFound;
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }
    }
}

function modifyOwner()
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $modSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Modification Successful.</code></p>
                    <p>Press anywhere to continue.</p>
                </div>
            </div>
        </div>

          <!-- Script to show the modal -->
        <script>
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
        </script>
    HTML;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $contact = $_POST["contact"];
        $ownerId = $_SESSION['owner_id'];

        $sql = "UPDATE property_owner
        SET first_name = ?, last_name = ?, email = ?, contact_no = ?
        WHERE owner_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fname, $lname, $email, $contact, $ownerId);
        if ($stmt->execute()) {
            echo $modSuccess;
            recordTransaction($user_id, "Property Owner Modification");
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);</script>';
}

function deleteOwner()
{
    global $conn;

    $deleteSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Record Deleted.</code></p>
                    <p>Press anywhere to continue.</p>
                </div>
            </div>
        </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
        </script>
    HTML;

    $ownerId = $_SESSION['owner_id'];

    $sql = "DELETE FROM property_owner WHERE owner_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $ownerId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Property Owner Deletion");
        } else {
            echo "Error executing the query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function printModProperty()
{
    global $conn;

    $propertyNotFound = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Id not found.</code></p>
                    <p>Press anywhere to continue.</p>
                </div>
            </div>
        </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
        </script>
    HTML;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findPropertyBtn'])) {

        $propertyId = $_POST['find'];
        $getPropertyRow = "SELECT * FROM property WHERE property_id = $propertyId";

        $_SESSION['property_id'] = $propertyId;

        $resultSet = $conn->query($getPropertyRow);

        if ($resultSet) {
            if ($resultSet->num_rows > 0) {
                $lastPropertyAddress = null;
                $row = $resultSet->fetch_assoc();

                echo '<h3><code>Record Selected.</code> </h3>';
                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Property Id</th><th>Account Id</th><th>Property Address</th><th>Value</th><th>Property Type</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["property_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["property_address"] . '</td><td>' . $row["value"] . '</td><td>' . $row["property_type"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["property_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["property_address"] . '</td><td>' . $rowDisplay["value"] . '</td><td>' . $rowDisplay["property_type"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyPropertyModal">Modify Record</button>';
                echo '<form method="POST">';

                echo '<button type="submit" class="btn btn-danger shadow px-4" name="deletePropertyBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
                echo '</form>';

                $lastPropertyAddress = $row["property_address"];
                $_SESSION['prev_address'] = $lastPropertyAddress;
            } else {
                echo $propertyNotFound;
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }
    }
}

function modifyProperty()
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $failed = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">WARNING!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>This address is already registered to another property.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
        HTML;
    $submitted = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Modification Successful.</code></p>
                        <p>Press anywhere to continue.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Script to show the modal -->
        <script>
            $(document).ready(function(){
                $('#myModal').modal('show');
            });
        </script>
        
    HTML;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $houseNo = $_POST['houseNo'];
        $street = $_POST['street'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $fullAddress = $houseNo . ', ' . $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
        $formatVal = (int)$_POST['propertyValue'];
        $value = number_format($formatVal);
        $propertyType = $_POST['listGroupRadio'];
        $propertyId = null;
        $prevAddress = $_SESSION['prev_address'];

        $sqlfindAddress = "SELECT * FROM property WHERE property_address = ?";
        $stmtFindAdd = $conn->prepare($sqlfindAddress);
        $stmtFindAdd->bind_param("s", $fullAddress);

        if ($stmtFindAdd->execute()) {
            $result = $stmtFindAdd->get_result();
            if ($result->num_rows > 0) {
                echo $failed;
            } else {
                $sql = "UPDATE property SET property_type = ?, value = ?, property_address = ? WHERE account_id = ? AND property_address = ?";
                $stmtUpdate = $conn->prepare($sql);
                var_dump($prevAddress);
                $stmtUpdate->bind_param("sssis", $propertyType, $value, $fullAddress, $user_id, $prevAddress);


                if ($stmtUpdate->execute()) {
                    // gets owner id
                    $sqlGetOwnerId = "SELECT owner_id FROM property_owner WHERE account_id = ?";
                    $stmtGetOwnerId = $conn->prepare($sqlGetOwnerId);
                    $stmtGetOwnerId->bind_param("i", $user_id);

                    if ($stmtGetOwnerId->execute()) {
                        $resultOwnerId = $stmtGetOwnerId->get_result();

                        if ($resultOwnerId->num_rows > 0) {
                            while ($rowOwner = $resultOwnerId->fetch_assoc()) {
                                $owner_id = $rowOwner['owner_id'];
                            }
                        }
                    } else {
                        echo "Error retrieving owner_id: " . $stmtGetOwnerId->error;
                    }
                    $stmtGetOwnerId->free_result();
                    $stmtGetOwnerId->close();

                    // gets the property id
                    $sqlGetProperty_Id = "SELECT property_id FROM property WHERE property_address = ?";
                    $stmtGetProperty = $conn->prepare($sqlGetProperty_Id);
                    $stmtGetProperty->bind_param("s", $fullAddress);

                    if ($stmtGetProperty->execute()) {
                        $result = $stmtGetProperty->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $propertyId = $row['property_id'];
                        } else {
                            echo "Error executing property_id retrieval query: " . $stmtGetProperty->error;
                        }
                    } else {
                        echo "Error: " . $stmtGetProperty->error;
                    }
                    $stmtGetProperty->free_result();
                    $stmtGetProperty->close();

                    setTax($formatVal, $propertyType, $propertyId, $owner_id);

                    recordTransaction($user_id, "Property Modification");

                    echo $submitted;
                } else {
                    echo "Error: " . $stmtUpdate->error;
                }
                $stmtUpdate->close();
            }
        } else {
            echo "Error: " . $stmtFindAdd->error;
        }
        $stmtFindAdd->close();
    }
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function deleteProperty()
{
    global $conn;

    $deleteSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Record Deleted.</code></p>
                    <p>Press anywhere to continue.</p>
                </div>
            </div>
        </div>
        </div>
    
        <!-- Script to show the modal -->
        <script>
        $(document).ready(function(){
            $('#myModal').modal('show');
        });
        </script>
    HTML;

    $propertyId = $_SESSION['property_id'];

    $sql = "DELETE FROM property WHERE property_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $propertyId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Property Deletetion");
        } else {
            echo "Error executing the query: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function recordTransaction($user_id, $type)
{
    global $conn;

    $sql = "INSERT INTO transactions (account_id, transaction_type, transaction_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $type);

    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}
?>