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
    <?php if(isset($_GET["rid"]) && !isset($_POST["submit_rating"])){ ?>
    <section>
        <form action="search_recipe_results_rating.php?rid=<?php echo $_GET["rid"]; ?>" method="post" id="searchRecipeForm">
                <section>
                    <h2>Rate your recipe:</h2>                    
                    <input type="range" min="1" max="5" step="1" value="3" name="rating_value">
                </section>
        
                
                <button type="submit" name="submit_rating" value="submitRating">Submit Rating</button>
            </form>
    </section>
    <?php } ?>
    <?php if(isset($_POST["submit_rating"]) && $_POST["submit_rating"] == "submitRating" ){
        $recipe_id = $_GET["rid"];
        $rating_value = $_POST["rating_value"];

        $rating_query = "";
        $rating_query .= "INSERT INTO recipe_rating ";
        $rating_query .= "(recipe_id, rating_value, rating_date) ";
        $rating_query .= "VALUES ";
        $rating_query .= "('$recipe_id', '$rating_value', NOW())";
    
        // echo $rating_query;
    
        $result = mysqli_query($connection, $rating_query);

        if($result) echo "<section><h2>Rating Added!</h2></section>";

        }
    ?>
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
