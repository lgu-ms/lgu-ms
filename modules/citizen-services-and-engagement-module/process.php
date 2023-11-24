<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php

$mysql_address = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_db = "citizen_services";
$debug = true;
$conn = new mysqli($mysql_address, $mysql_user, $mysql_password, $mysql_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function submitServices()
{
    global $conn;

    $submitted = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Services Submitted Successfully.</code></p>
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
        $name = $_POST["name"];
        $description = $_POST["desc"];
        $user_id = $_SESSION["user_id"];

        $sql = "INSERT INTO services (account_id, service_name, description, request_date, status) VALUES (?, ?, ?, NOW(), 'Candidate for Review')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $name, $description);

        if ($stmt->execute()) {
            echo $submitted;
        } else {
            echo "Error: " . $stmt->error;
        }

        recordTransaction($user_id, "Service Submmission");
    }
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function submitFeedback()
{
    global $conn;

    $submitted = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p style = "font-size: 25px;"><code>Feedback Submitted Successfully.</code></p>
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

        $feedback = $_POST["feedback"];
        $rating = $_POST["rating"];
        $user_id = $_SESSION["user_id"];

        $sql = "INSERT INTO citizen_feedback (account_id, feedback_date, rating, feedback) VALUES (?, NOW(), ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $rating, $feedback);

        if ($stmt->execute()) {
            echo $submitted;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
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
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
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

        $sql = "INSERT INTO citizen (account_id, first_name, last_name, email, contact_no) VALUES ( ?, ?, ?, ?, ?)";
        $stored_id = "SELECT * FROM citizen WHERE account_id = '$user_id'";
        $result = $conn->query($stored_id);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $user_id, $fname, $lname, $email, $contact);

        if ($result) {
            if ($result->num_rows > 0) {
                echo $regFailed;
            } else {
                echo "No records found for account ID: $user_id";
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

function getTables($tableName, $function)
{
    global $conn;

    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    switch ($tableName) {

        case "citizen":
            if ($result->num_rows > 0) {

                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Citizen Id</th><th>Account Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact No.</th></tr></thead>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["c_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["contact_no"] . '</td></tr></tbody>';
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            break;

        case "citizen_feedback":
            if ($result->num_rows > 0) {

                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Feedback Id</th><th>Account Id</th><th>Feedback Date</th><th>Rating</th><th>Feedback</th></tr></thead>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["feedback_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["feedback_date"] . '</td><td>' . $row["rating"] . '</td><td>' . $row["feedback"] . '</td></tr></tbody>';
                }
                echo "</table>";
            } else {
                echo "0 results";
            }
            break;

        case "services":

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

                        $serviceId = $_POST['find'];
                        $getServiceRow = "SELECT * FROM $tableName WHERE service_id = $serviceId";

                        $_SESSION['serviceId'] = $serviceId;

                        $resultSet = $conn->query($getServiceRow);

                        if ($resultSet) {
                            if ($resultSet->num_rows > 0) {

                                $row = $resultSet->fetch_assoc();

                                echo '<h2 class="text-center mb-4" style="margin-top: 50px">Manage Service Requests</h2>';
                                echo '<table class="table table-hover " style="text-align:center;">';
                                echo '<thead  class="table-light"><tr><th>Service Id</th><th>Account Id</th><th>Service Name</th><th>Description</th><th>Request Date</th><th>Status</th></tr></thead>';

                                echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';

                                while ($rowDisplay = $resultSet->fetch_assoc()) {
                                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["service_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["service_name"] . '</td><td>' . $rowDisplay["description"] . '</td><td>' . $rowDisplay["request_date"] . '</td><td>' . $rowDisplay["status"] . '</td></tr></tbody>';
                                }
                                echo "</table>";
                                echo '<form method="POST" action="managers.php">';
                                echo '<input type="hidden" name="serviceId" value="' . $row["service_id"] . '">';
                                echo '<button class="btn btn-primary shadow px-4" name="approveBtn" id="approveBtn type="submit"">Approve</button>';
                                echo '<button class="btn btn-danger shadow px-4" name="denyBtn" id="denyBtn" type="submit">Deny</button>';
                                echo '</form>';
                            } else {
                                echo $notFound;
                                echo "No results found for '$serviceId'";
                            }
                        } else {
                            echo "Error executing the query: " . $conn->error;
                        }
                    }
                    break;

                case 'display':
                    if ($result->num_rows > 0) {

                        echo '<table class="table table-hover " style="text-align:center;">';
                        echo '<thead  class="table-light"><tr><th>Service Id</th><th>Account Id</th><th>Service Name</th><th>Description</th><th>Request Date</th></th><th>Status</th></tr></thead>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }
                    break;
            }
            break;
        default:
            break;
    }
}

function approveService()
{
    global $conn;

    $updateSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Service Approved.</code></p>
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

    $updateFailed = <<<HTML
        <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Record failed updating.</code></p>
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
    $user_id = $_SESSION['user_id'];
    $storedServiceId = $_SESSION['serviceId'];
    $update = $conn->prepare("UPDATE services SET status = 'Approved' WHERE service_id = ?");
    $update->bind_param("i", $storedServiceId);

    if ($update->execute()) {
        echo $updateSuccess;
        recordTransaction($user_id, "Service Approval");
    } else {
        echo $updateFailed;
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);</script>';
}

function denyService()
{
    global $conn;

    $updateSuccess = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Service Denied.</code></p>
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

    $updateFailed = <<<HTML
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 25px;"><code>Record are not updated.</code></p>
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
    $user_id = $_SESSION['user_id'];
    $storedServiceId = $_SESSION['serviceId'];
    $update = $conn->prepare("UPDATE services SET status = 'Denied' WHERE service_id = ?");
    $update->bind_param("i", $storedServiceId);

    if ($update->execute()) {
        echo $updateSuccess;
        recordTransaction($user_id, "Service Denial");
    } else {
        echo $updateFailed;
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 3000);</script>';
}

function printModCitizen()
{
    global $conn;

    $citizenNotFound = <<<HTML
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findCitizenBtn'])) {

        $citizenId = $_POST['find'];
        $getCitizenRow = "SELECT * FROM citizen WHERE c_id = $citizenId";

        $_SESSION['citizenId'] = $citizenId;

        $resultSet = $conn->query($getCitizenRow);

        if ($resultSet) {
            if ($resultSet->num_rows > 0) {

                $row = $resultSet->fetch_assoc();

                echo '<h3><code>Record Selected.</code> </h3>';
                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Citizen Id</th><th>Account Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact No.</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["c_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["contact_no"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["c_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["first_name"] . '</td><td>' . $rowDisplay["last_name"] . '</td><td>' . $rowDisplay["email"] . '</td><td>' . $rowDisplay["contact_no"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyCitizenModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4" name="deleteCitizenBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
                echo '</form>';
            } else {
                echo $citizenNotFound;
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }
    }
}

function modifyCitizen()
{
    global $conn;

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
        $citizenId = $_SESSION['citizenId'];
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE citizen
        SET first_name = ?, last_name = ?, email = ?, contact_no = ?
        WHERE c_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fname, $lname, $email, $contact, $citizenId);

        if ($stmt->execute()) {
            echo $modSuccess;
            recordTransaction($user_id, "Account Modification");
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

function deleteCitizen()
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

    $citizenId = $_SESSION['citizenId'];
    $user_id = $_SESSION['user_id'];

    $sql = "DELETE FROM citizen WHERE c_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $citizenId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            recordTransaction($user_id, "Account Deletion");
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

function printModFeedback()
{
    global $conn;

    $feedbackNotFound = <<<HTML
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findFeedbackBtn'])) {

        $feedbackId = $_POST['find'];
        $getFeedbackRow = "SELECT * FROM citizen_feedback WHERE feedback_id = $feedbackId";

        $_SESSION['feedbackId'] = $feedbackId;

        $resultSet = $conn->query($getFeedbackRow);

        if ($resultSet) {
            if ($resultSet->num_rows > 0) {

                $row = $resultSet->fetch_assoc();

                echo '<h3><code>Record Selected.</code> </h3>';
                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Feedback Id</th><th>Account Id</th><th>Feedback Date</th><th>Rating</th><th>Feedback</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["feedback_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["feedback_date"] . '</td><td>' . $row["rating"] . '</td><td>' . $row["feedback"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["feedback_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["feedback_date"] . '</td><td>' . $rowDisplay["rating"] . '</td><td>' . $rowDisplay["feedback"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyFeedbackModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4" name="deleteFeedbackBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
                echo '</form>';
            } else {
                echo $feedbackNotFound;
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }
    }
}

function modifyFeedback()
{
    global $conn;

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

        $feedback = $_POST["feedback"];
        $rating = $_POST["rating"];
        $feedbackId = $_SESSION['feedbackId'];

        $sql = "UPDATE citizen_feedback SET feedback_date = NOW(), rating = ?, feedback = ? WHERE feedback_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isi", $rating, $feedback, $feedbackId);

        if ($stmt->execute()) {
            echo $submitted;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Feedback Modification");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $conn->close();
    echo '<script>setTimeout(function() {
        window.location.href = "index.php";
    }, 2000);</script>';
}

function deleteFeedBack()
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

    $feedbackId = $_SESSION['feedbackId'];

    $sql = "DELETE FROM citizen_feedback WHERE feedback_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $feedbackId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Feedback Deletion");
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

function printModService()
{
    global $conn;

    $serviceNotFound = <<<HTML
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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['findServiceBtn'])) {

        $serviceId = $_POST['find'];
        $getServiceRow = "SELECT * FROM services WHERE service_id = $serviceId";

        $_SESSION['serviceId'] = $serviceId;

        $resultSet = $conn->query($getServiceRow);

        if ($resultSet) {
            if ($resultSet->num_rows > 0) {

                $row = $resultSet->fetch_assoc();

                echo '<h3><code>Record Selected.</code> </h3>';
                echo '<table class="table table-hover " style="text-align:center;">';
                echo '<thead  class="table-light"><tr><th>Service Id</th><th>Account Id</th><th>Service Name</th><th>Description</th><th>Request Date</th><th>Status</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["account_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["service_id"] . '</td><td>' . $rowDisplay["account_id"] . '</td><td>' . $rowDisplay["service_name"] . '</td><td>' . $rowDisplay["description"] . '</td><td>' . $rowDisplay["request_date"] . '</td><td>' . $rowDisplay["status"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyServiceModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4" name="deleteServiceBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
                echo '</form>';
            } else {
                echo $serviceNotFound;
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }
    }
}

function modifyService()
{
    global $conn;

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

        $serviceName = $_POST["name"];
        $description = $_POST["desc"];
        $serviceId = $_SESSION['serviceId'];

        $sql = "UPDATE services SET service_name = ?, description = ?, request_date = NOW() WHERE service_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $serviceName, $description, $serviceId);

        if ($stmt->execute()) {
            echo $submitted;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Service Modification");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $conn->close();
    echo '<script>setTimeout(function() {
    window.location.href = "index.php";
    }, 2000);</script>';
}

function deleteService()
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

    $serviceId = $_SESSION['serviceId'];

    $sql = "DELETE FROM services WHERE service_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $serviceId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            $user_id = $_SESSION['user_id'];
            recordTransaction($user_id, "Service Deletion");
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
    $conn->close();
}
?>