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

    <section>
        <form action="search_recipe_results.php" method="post" id="searchRecipeForm">
            <section>
                <h2>Search for a Recipe:</h2>
                
                <label for="recipeName">Recipe Name:</label>
                <input type="text" id="recipeName" name="recipeName">

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
            </section>
    
              
            <button type="submit" name="search_recipe" value="searchRecipe">Search Recipe</button>
        </form>
    </section>
   


    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
