<?php require_once("includes/connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/styles.css">
    <title>Recipe Book - Create a Recipe</title>
</head>
<body>
    <header>
        <h1>Create a Recipe</h1>
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

        //this will handle the preparation of the first recipe information
        if(isset($_POST["next"]) && $_POST["next"] == "next"){
            $recipe_name = $_POST["recipeName"];
            $category_id = $_POST["recipeCategory"];
            $recipe_instructions = $_POST["recipeInstructions"];

            $query = " ";
            $query .= "INSERT INTO recipe ";
            $query .= "(recipe_name, recipe_instructions, category_id, recipe_creation_date, recipe_last_edit_date) ";
            $query .= "VALUES ";
            $query .= "('$recipe_name', '$recipe_instructions', '$category_id', NOW(), NOW()); ";

        session_start();
        $_SESSION["insert_recipe_query"] = $query;
        $_SESSION["recipe_name"] = $recipe_name;

        require_once("create_recipe_form_ingredients.php");

        }
        elseif (isset($_POST["add_more_ingredients"]) && $_POST["add_more_ingredients"] == "addMore"){
            $ingredient_id = $_POST["recipeIngredient"];
            $recipe_ingredient_value = $_POST["recipeIngredientValue"];
            $unit_id = $_POST["unitID"];

            session_start();
            $recipe_name = $_SESSION["recipe_name"];

            $query = "SET @recipe_id = (SELECT recipe_id FROM recipe WHERE recipe_name = '$recipe_name'); ";
            $query .= "INSERT INTO recipe_ingredient ";
            $query .= "(recipe_id, ingredient_id, recipe_ingredient_value, unit_id) ";
            $query .= "VALUES ";
            $query .= "(@recipe_id, '$ingredient_id', '$recipe_ingredient_value', '$unit_id'); ";
            
            $_SESSION["insert_recipe_query"] .= $query;

            require_once("create_recipe_form_ingredients.php");
            
        }
        elseif(isset($_POST["submit_recipe"]) && $_POST["submit_recipe"] == "submitRecipe"){
            $ingredient_id = $_POST["recipeIngredient"];
            $recipe_ingredient_value = $_POST["recipeIngredientValue"];
            $unit_id = $_POST["unitID"];

            session_start();
            $recipe_name = $_SESSION["recipe_name"];

            $query = "SET @recipe_id = (SELECT recipe_id FROM recipe WHERE recipe_name = '$recipe_name'); ";
            $query .= "INSERT INTO recipe_ingredient ";
            $query .= "(recipe_id, ingredient_id, recipe_ingredient_value, unit_id) ";
            $query .= "VALUES ";
            $query .= "(@recipe_id, '$ingredient_id', '$recipe_ingredient_value', '$unit_id'); ";
            
            $_SESSION["insert_recipe_query"] .= $query; 

            $final_query = $_SESSION["insert_recipe_query"];
            
            $result = mysqli_multi_query($connection, $final_query);

            if($result){
                $_SESSION["insert_recipe_query"] = "";
                $_SESSION["recipe_name"] = "";

                echo "<section><h1>Bonne Appetite</h1></section>";
            }
        }

    ?>

    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>