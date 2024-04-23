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
    <section>
        <form action="create_recipe_add_ingredients.php" method="post" id="createRecipeFormPrimaryInfo">
                <h2>Recipe Primary Information</h2>
                <label for="recipeName">Recipe Name:</label>
                <input type="text" id="recipeName" name="recipeName" required>

                <?php
                    $queryCat = "SELECT category_id, category_name FROM category";
                    $result = mysqli_query($connection, $queryCat);

                ?>
                 <label for="recipeCategory">Recipe Category:</label>
                <select id="recipeCategory" name="recipeCategory" required>
                    <option value="--">-- Select a Category --</option>

                    <?php while($result_set = mysqli_fetch_array($result)){ ?>
                    <option value="<?php echo $result_set["category_id"] ?>"><?php echo $result_set["category_name"] ?></option>
                    <?php } ?>

                </select>

                <label for="recipeInstructions">Recipe Instructions</label>
                <textarea id="recipeInstructions" name="recipeInstructions" rows="4"></textarea>
                <button type="submit" name="next" value="next">Next</button>
        </form>
    </section> 
    
    
    
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
