<?php

//Initializes MySQLi
/**
 * @return void
 */
function initializesMySQLi()
{
    echo DB_NAME;
    $con=mysqli_init();

    // configure DB server SSL
    mysqli_ssl_set($con, NULL, NULL, NULL, NULL, NULL);
    // Establish the connection
    mysqli_real_connect($con, "fit5120db.mysql.database.azure.com", "fit5120admin@fit5120db", "Ab12345678", "demodb", 3306);

    //If connection failed, show the error
    if (mysqli_connect_errno()) {
        die('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

//Attempt select query execution
    $sql = "SELECT * FROM unit";
    if ($result = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>unit name</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['unitname'] . "</td>";
                echo "</tr>";
            }
            echo $result;
// Close result set
            mysqli_free_result($result);
        } else {
            echo "No records matching your query were found.";
        }
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
//Close connection
    mysqli_close($con);
}

initializesMySQLi();