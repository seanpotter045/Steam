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

            $ingredients_result= mysqli_query($connection, $ingredients_query);

            

        }
    ?>

    <section>
        <h2>Edit a Recipe</h2>
        <form action="search_recipe_edit_update.php?rid=<?php echo $recipe["recipe_id"]; ?>" method="post" id="editRecipeForm">
            <label for="recipeName">Recipe Name:</label>
                <input type="text" id="recipeName" name="recipeName" value="<?php echo $recipe["recipe_name"]; ?>" required>
                <?php
                    $category_query = "SELECT category_id, category_name FROM category";
                    $category_result = mysqli_query($connection, $category_query);

                ?>
                <label for="recipeCategory">Recipe Category:</label>
                <select id="recipeCategory" name="recipeCategory" required>
                    <option value="--">-- Select a Category --</option>

                    <?php while($category = mysqli_fetch_array($category_result)){ ?>
                    
                    <option <?php if($recipe["category_id"] == $category["category_id"]) echo "selected" ?> value="<?php echo $category["category_id"] ?>"><?php echo $category["category_name"] ?></option>
                    <?php } ?>

                </select>

                <label for="recipeInstructions">Recipe Instructions</label>
                <textarea id="recipeInstructions" name="recipeInstructions" rows="4"><?php echo $recipe["recipe_instructions"]; ?></textarea>

                <h2>Recipe Ingredients</h2>
                <?php $i = 0; ?>
                <?php while($ingredient = mysqli_fetch_array($ingredients_result)){ ?>
                <?php $i++; ?>

                <label for="recipeIngredient">Ingredient:</label>
                <select id="recipeIngredient" name="recipeIngredient<?php echo $i; ?>" required>
                    <option value="--">-- Select Ingredient --</option>

                    <?php
                        $queryIng = "SELECT ingredient_id, ingredient_name FROM ingredient";
                        $result = mysqli_query($connection, $queryIng); 
                    ?>
                    <?php while($result_set = mysqli_fetch_array($result)){ ?>
                    <option <?php if($ingredient["ingredient_id"] == $result_set["ingredient_id"]) echo "selected" ?> value="<?php echo $result_set["ingredient_id"]; ?>"><?php echo $result_set["ingredient_name"]; ?></option>
                    <?php } ?>
                    
                </select>

                <label for="recipeIngredientValue">Quantity:</label>
                <input value="<?php echo $ingredient["recipe_ingredient_value"]; ?>" type="number" id="recipeIngredientValue" name="recipeIngredientValue<?php echo $i; ?>" required>
                <?php
                        $queryUnit = "SELECT unit_id, unit_name FROM unit";
                        $unit_result = mysqli_query($connection, $queryUnit); 
                    ?>
                <label for="ingredientUnitSelect">Select Unit:</label>
                <select id="ingredientUnitSelect" name="unitID<?php echo $i; ?>">
                    <option value="--"> -- Choose a Unit -- </option>
                    <?php while($unit = mysqli_fetch_array($unit_result)){ ?>
                    <option <?php if($ingredient["unit_id"] == $unit["unit_id"]) echo "selected" ?> value="<?php echo $unit["unit_id"]; ?>"><?php echo $unit["unit_name"]; ?></option>
                    <?php } ?>
                </select>
    
                <label for="comments">Additional Comments:</label>
                <textarea id="comments" name="comments" rows="4"></textarea>
                <?php } ?>
                <input type="hidden" id="numberOfIngredients" name="numberOfIngredients" value="<?php echo $i; ?>">     
            <button type="submit">Edit Recipe</button>
        </form>
    </section>


    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
