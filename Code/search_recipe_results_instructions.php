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

            $recipe_query = "";
            $recipe_query .= "SELECT * ";
            $recipe_query .= "FROM recipe ";
            $recipe_query .= "INNER JOIN category ON recipe.category_id = category.category_id ";
            $recipe_query .= "WHERE recipe_id = $recipe_id LIMIT 1";

            // echo $query;

            $result = mysqli_query($connection, $recipe_query);

            $recipe = mysqli_fetch_array($result);

            $ingredients_query = "";
            $ingredients_query .= "SELECT * ";
            $ingredients_query .= "FROM recipe_ingredient ";
            $ingredients_query .= "INNER JOIN ingredient ON recipe_ingredient.ingredient_id = ingredient.ingredient_id ";
            $ingredients_query .= "INNER JOIN unit ON recipe_ingredient.unit_id = unit.unit_id ";
            $ingredients_query .= "WHERE recipe_id = $recipe_id";

            // echo $ingredients_query;

            $ingredients_result = mysqli_query($connection, $ingredients_query);

        }
    ?>
    <section>
        <h2>Recipe Instuctions and Ingredients of <?php echo $recipe["recipe_name"]; ?></h2>
        <h3>Instructions</h3>
        <p><?php echo $recipe["recipe_instructions"]; ?></p>
        <h3>Ingredients</h3>
        <table>
            <?php while($ingredient = mysqli_fetch_array($ingredients_result)){ ?>
            <tr>
                <th><?php echo $ingredient["ingredient_name"]; ?></th>    
                <td><?php echo $ingredient["recipe_ingredient_value"]; ?></td>
                <td><?php echo $ingredient["unit_name"]; ?></td>
            </tr>
            <?php } ?>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
