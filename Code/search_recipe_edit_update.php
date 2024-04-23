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

    <?php
        if(isset($_GET["rid"])){
            $recipe_id = $_GET["rid"];

            $i = $_POST["numberOfIngredients"];
            $recipe_name = $_POST["recipeName"];
            $category_id = $_POST["recipeCategory"];
            $recipe_instructions = $_POST["recipeInstructions"];


            for($j = 1; $j <= $i; $j++){
                $ingredient_id[$j] = $_POST["recipeIngredient" . $j];
                $ingredient_quantity[$j] = $_POST["recipeIngredientValue" . $j];
                $unitID[$j] = $_POST["unitID" . $j];
            }


            $query = "";
            $query .= "UPDATE recipe SET ";
            $query .= "recipe_name = '$recipe_name', ";
            $query .= "recipe_instructions = '$recipe_instructions', ";
            $query .= "recipe_last_edit_date = NOW() ";
            $query .= "WHERE recipe_id = '$recipe_id'; ";

            $query .= "DELETE FROM recipe_ingredient WHERE recipe_id = '$recipe_id'; ";

            for($j = 1; $j <= $i; $j++){

                $query .= "INSERT INTO recipe_ingredient ";
                $query .= "(recipe_id, ingredient_id, recipe_ingredient_value, unit_id) ";
                $query .= "VALUES ";
                $query .= "('$recipe_id', '{$ingredient_id[$j]}', '{$ingredient_quantity[$j]}', '{$unitID[$j]}'); ";
                
            }

            // echo "<section>" . $query . "</section>";
     
         

            $result= mysqli_multi_query($connection, $query);

            if($result) echo "<section>Your $recipe_name has been edited!</section>";

        }
    ?>

    
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
