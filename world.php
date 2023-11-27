<?php

    $host = 'localhost';
    $username = 'lab5_user';
    $password = 'password123';
    $dbname = 'world';

    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    # Check if the country parameter is set in the GET request

    if (isset($_GET['country'])) 
    {

        $country = $_GET['country'];
        
        # Use a prepared statement to prevent SQL injection

        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindValue(':country', '%' . $country . '%', PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) 
        {

            # Output the results in an HTML table

            echo '<table class="result-table">
                    <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Continent</th>
                            <th>Independence Year</th>
                            <th>Head of State</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($results as $row) 
            {

                echo '<tr>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['continent'] . '</td>
                        <td>' . $row['independence_year'] . '</td>
                        <td>' . $row['head_of_state'] . '</td>
                    </tr>';

            }

            echo '</tbody></table>';
            
        } 
        else 
        {
        
            echo 'No matching countries found.';
        
        }

    } 
    else 
    {

        echo 'Country parameter not set.';
        
    }

?>
