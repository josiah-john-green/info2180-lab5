<?php

    $host = 'localhost';
    $username = 'lab5_user';
    $password = 'password123';
    $dbname = 'world';

    # Establish a connection to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    # Check if a country parameter is provided in the URL
    if (isset($_GET['country'])) 
    {

        # Use prepared statement to prevent SQL injection
        $countryParam = '%' . $_GET['country'] . '%';
        
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");

        # Bind the parameter
        $stmt->bindParam(':country', $countryParam, PDO::PARAM_STR);

    } 
    else 
    {
    
        # If no country parameter, fetch all countries
        $stmt = $conn->query("SELECT * FROM countries");
    
    }

    # Execute the query
    $stmt->execute();

    # Fetch results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Output the results as an unordered list -->

<ul>
    <?php 
        foreach ($results as $row): 
    ?>
    
        <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
    
    <?php 
        endforeach; 
    ?>
</ul>
