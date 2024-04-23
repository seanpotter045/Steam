<?php require_once("includes/connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="styles/styles.css">
    <title>Recipe Book - Search/Edit a Recipe</title>
</head>

<body>
    <header>
        <h1>Search/Edit a Recipe</h1>
    </header>
     <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="create_recipe.php">Create Recipe</a></li>
            <li><a href="search_recipe.php">Search a Recipe</a></li>         
            <li><a href="ingredients_management.php">Ingredients Management</a></li>
        </ul>
    </nav>
    <?php if(isset($_GET["rid"])){
        $recipe_id = $_GET["rid"];
        
        $delete_query = "";
        $delete_query .= "DELETE FROM recipe_rating where recipe_id = '$recipe_id'; ";
        $delete_query .= "DELETE FROM recipe_ingredient where recipe_id = '$recipe_id'; ";
        $delete_query .= "DELETE FROM recipe where recipe_id = '$recipe_id';";
    
        // echo $rating_query;
    
        $result = mysqli_multi_query($connection, $delete_query);

        if($result) echo "<section><h2>Recipe Deleted!</h2></section>";

        }
    ?>
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
