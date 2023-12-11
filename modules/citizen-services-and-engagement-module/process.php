<?php

include("../../include/config.php");

try {
    $conn = new mysqli($mysql_address, $mysql_cs_e_user, $mysql_cs_e_pass, $mysql_cs_e_db);

    $conn->connect_error;

} catch (Exception $a) {
    if ($debug) {
        echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><title>Houston! Database Error</title></head><body><style>* {transition: all 0.6s;}html {height: 100%;}body {font-family: "Lato", sans-serif;color: #888;margin: 0;}#main {display: table;width: 100%;height: 100vh;text-align: center;}.fof {display: table-cell;vertical-align: middle;}.fof h1 {font-size: 50px;display: inline-block;padding-right: 12px;animation: type 0.5s alternate infinite;}@keyframes type {from {box-shadow: inset -3px 0px 0px #888;}to {box-shadow: inset -3px 0px 0px transparent;}}</style><div id="main"><div class="fof"><h1>OOPS!</h1><h3>looks like there is a database issue.</h3><p>' . str_replace("\n", "<br>", $a) . '</p></div></div></body><html>';
    } else {
        http_response_code(500);
    }
    die();
}

function getSessionId()
{
    global $conn;

    // Gets session id for recording transactions
    $today = $_SESSION["session_started"];
    $query = "SELECT _sid FROM account_session WHERE session_started = ? AND user_id = ?";
    $user_id = $_SESSION["login_temp_user_id"];
    $stmtSessionId = $conn->prepare($query);

    if ($stmtSessionId) {
        $stmtSessionId->bind_param("si", $today, $user_id);
        $stmtSessionId->execute();

        $result = $stmtSessionId->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $session_id = $row['_sid'];
            $stmtSessionId->close();
            return $session_id;
        } else {
            $stmtSessionId->close();
            return null;
        }
    } else {
        return null;
    }
}
function getCitizenId()
{
    global $conn;

    // Gets session id for recording transactions
    $user_id = $_SESSION["login_temp_user_id"];
    $sql = "SELECT citizen_id FROM citizen WHERE account_id = $user_id";
    $result = $conn->query($sql);
    if ($result) {
        $citizenId = 0;
        while ($row = $result->fetch_assoc()) {
            $citizenId = $row['citizen_id'];
        }
        return $citizenId; // Return the retrieved citizen ID
    } else {
        echo "Error executing the query: " . $conn->error;
        return 0; // Return a default value or handle error case
    }
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
        $user_id = $_SESSION["login_temp_user_id"];

        // gets the citizen id
        $user_id = $_SESSION["login_temp_user_id"];
        $sql = "SELECT citizen_id FROM citizen WHERE account_id = $user_id";

        $result = $conn->query($sql);

        if ($result) {
            $citizenId = 0;
            while ($row = $result->fetch_assoc()) {
                $citizenId = $row['citizen_id'];
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }


        $name = $_POST["name"];
        $description = $_POST["desc"];

        $sql = "INSERT INTO services (citizen_id, service_name, description, request_date, status) VALUES (?, ?, ?, NOW(), 'Candidate for Review')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $citizenId, $name, $description);

        if ($stmt->execute()) {
            echo $submitted;
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Service Submmission");
        } else {
            echo "Error: " . $stmt->error;
        }
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
        // gets the citizen id
        $user_id = $_SESSION["login_temp_user_id"];
        $sql = "SELECT citizen_id FROM citizen WHERE account_id = $user_id";

        $result = $conn->query($sql);

        if ($result) {
            $citizenId = 0;
            while ($row = $result->fetch_assoc()) {
                $citizenId = $row['citizen_id'];
            }
        } else {
            echo "Error executing the query: " . $conn->error;
        }

        $feedback = $_POST["feedback"];
        $rating = $_POST["rating"];

        $sql = "INSERT INTO citizen_feedback (citizen_id, feedback_date, rating, feedback) VALUES (?, NOW(), ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $citizenId, $rating, $feedback);

        if ($stmt->execute()) {
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Feedback Submmission");
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
        $user_id = $_SESSION["login_temp_user_id"];

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
                    $citizen_id = getCitizenId();
                    $session_id = getSessionId();
                    recordTransaction($session_id, $citizen_id, "Account Registrtion");
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
                echo '<thead  class="table-light"><tr><th>Feedback Id</th><th>Citizen Id</th><th>Feedback Date</th><th>Rating</th><th>Feedback</th></tr></thead>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $row["feedback_id"] . '</td><td>' . $row["citizen_id"] . '</td><td>' . $row["feedback_date"] . '</td><td>' . $row["rating"] . '</td><td>' . $row["feedback"] . '</td></tr></tbody>';
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
                                echo '<thead  class="table-light"><tr><th>Service Id</th><th>Citizen Id</th><th>Service Name</th><th>Description</th><th>Request Date</th><th>Status</th></tr></thead>';

                                echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["citizen_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';

                                while ($rowDisplay = $resultSet->fetch_assoc()) {
                                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["service_id"] . '</td><td>' . $rowDisplay["citizen_id"] . '</td><td>' . $rowDisplay["service_name"] . '</td><td>' . $rowDisplay["description"] . '</td><td>' . $rowDisplay["request_date"] . '</td><td>' . $rowDisplay["status"] . '</td></tr></tbody>';
                                }
                                echo "</table>";
                                echo '<form method="POST">';
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
                        echo '<thead  class="table-light"><tr><th>Service Id</th><th>Citizen Id</th><th>Service Name</th><th>Description</th><th>Request Date</th></th><th>Status</th></tr></thead>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["citizen_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';
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

    $storedServiceId = $_SESSION['serviceId'];
    $update = $conn->prepare("UPDATE services SET status = 'Approved' WHERE service_id = ?");
    $update->bind_param("i", $storedServiceId);

    if ($update->execute()) {
        echo $updateSuccess;
        $citizen_id = getCitizenId();
        $session_id = getSessionId();
        recordTransaction($session_id, $citizen_id, "Service Approval");
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

    $storedServiceId = $_SESSION['serviceId'];
    $update = $conn->prepare("UPDATE services SET status = 'Denied' WHERE service_id = ?");
    $update->bind_param("i", $storedServiceId);

    if ($update->execute()) {
        echo $updateSuccess;
        $citizen_id = getCitizenId();
        $session_id = getSessionId();
        recordTransaction($session_id, $citizen_id, "Service Denial");
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
                echo '<button class="btn btn-primary shadow px-4 m-3" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyCitizenModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4 m-3" name="deleteCitizenBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
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
        $sql = "UPDATE citizen
        SET first_name = ?, last_name = ?, email = ?, contact_no = ?
        WHERE c_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fname, $lname, $email, $contact, $citizenId);

        if ($stmt->execute()) {
            echo $modSuccess;
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Account Modification");
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

    $sql = "DELETE FROM citizen WHERE c_id = ?";

    if ($stmt = $conn->prepare($sql)) {

        $stmt->bind_param("i", $citizenId);

        if ($stmt->execute()) {
            echo $deleteSuccess;
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Account Deletion");
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
                echo '<thead  class="table-light"><tr><th>Feedback Id</th><th>Citizen Id</th><th>Feedback Date</th><th>Rating</th><th>Feedback</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["feedback_id"] . '</td><td>' . $row["citizen_id"] . '</td><td>' . $row["feedback_date"] . '</td><td>' . $row["rating"] . '</td><td>' . $row["feedback"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["feedback_id"] . '</td><td>' . $rowDisplay["citizen_id"] . '</td><td>' . $rowDisplay["feedback_date"] . '</td><td>' . $rowDisplay["rating"] . '</td><td>' . $rowDisplay["feedback"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4 m-3" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyFeedbackModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4 m-3" name="deleteFeedbackBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
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
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Feedback Modification");
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
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Feedback Deletion");
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
                echo '<thead  class="table-light"><tr><th>Service Id</th><th>Citizen Id</th><th>Service Name</th><th>Description</th><th>Request Date</th><th>Status</th></tr></thead>';

                echo '<tbody class="table-dark"><tr><td>' . $row["service_id"] . '</td><td>' . $row["citizen_id"] . '</td><td>' . $row["service_name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["request_date"] . '</td><td>' . $row["status"] . '</td></tr></tbody>';

                while ($rowDisplay = $resultSet->fetch_assoc()) {
                    echo '<tbody class="table-dark"><tr><td>' . $rowDisplay["service_id"] . '</td><td>' . $rowDisplay["citizen_id"] . '</td><td>' . $rowDisplay["service_name"] . '</td><td>' . $rowDisplay["description"] . '</td><td>' . $rowDisplay["request_date"] . '</td><td>' . $rowDisplay["status"] . '</td></tr></tbody>';
                }
                echo '<button class="btn btn-primary shadow px-4 m-3" style="align-items:center;" name="modifyBtn" data-bs-toggle="modal" data-bs-target="#modifyServiceModal">Modify Record</button>';
                echo '<form method="POST">';
                echo '<button type="submit" class="btn btn-danger shadow px-4 m-3" name="deleteServiceBtn" onclick="return confirm(\'Are you sure you want to delete?\');">Delete Record</button>';
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
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Service Modification");
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
            $citizen_id = getCitizenId();
            $session_id = getSessionId();
            recordTransaction($session_id, $citizen_id, "Service Deletion");
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

function recordTransaction($session_id, $citizen_id, $type)
{
    global $conn;

    $sql = "INSERT INTO transactions (session_id, citizen_id, transaction_type, transaction_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $session_id, $citizen_id, $type);

    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
