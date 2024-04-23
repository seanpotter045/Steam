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
        if(isset($_POST["search_recipe"]) && $_POST["search_recipe"] == "searchRecipe" ){
           $recipe_name = strtolower($_POST["recipeName"]);
           $category_id = $_POST["recipeCategory"];
           if($category_id == "--") $category_id = "";

           $query = "";
           $query .= "SELECT DISTINCT * ";
           $query .= "FROM recipe ";
           $query .= "INNER JOIN category ON recipe.category_id = category.category_id ";
           $query .= "WHERE LOWER(recipe.recipe_name) LIKE '%$recipe_name%' ";
           $query .= "AND category.category_id LIKE '%$category_id%'";

           // echo $query;

           $result = mysqli_query($connection, $query);
        }
    ?>
    <section>
        <h2>Click on the Edit Button to edit the selected Application</h2>
        <table>
            <thead>
                <tr>
                    <th>Recipe Name</th>
                    <th>Recipe Category</th>
                    <th>Creation Date</th>
                    <th>Last Updated Date</th>
                    <th>Rating</th>
                    <th>Instructions</th>
                    <th>Edit</th>
                    <th>Rate</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample data, replace with actual records from your database -->

            <?php while($result_set = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $result_set["recipe_name"]; ?></td>
                    <td><?php echo $result_set["category_name"]; ?></td>
                    <td><?php echo $result_set["recipe_creation_date"]; ?></td>
                    <td><?php echo $result_set["recipe_last_edit_date"]; ?></td>
                    <?php
                        $rating_query = "SELECT AVG(rating_value) AS rating_average ";
                        $rating_query .= "FROM recipe_rating WHERE recipe_id = ";
                        $rating_query .= $result_set["recipe_id"];
                        // echo $rating_query;
                        $rating_result = mysqli_query($connection, $rating_query);
                        $rating_average = mysqli_fetch_array($rating_result);
                    ?>
                    <td><?php echo $rating_average["rating_average"]; ?></td>
                    <td><a id="instLink" href="search_recipe_results_instructions.php?rid=<?php echo $result_set["recipe_id"]; ?>">Instructions</a></td>
                    <td><a id="editLink" href="search_recipe_edit.php?rid=<?php echo $result_set["recipe_id"]; ?>">Edit</a></td>
                    <td><a id="rateLink" href="search_recipe_results_rating.php?rid=<?php echo $result_set["recipe_id"]; ?>">Rate</a></td>
                    <td><a id="deleteLink" href="search_recipe_results_delete.php?rid=<?php echo $result_set["recipe_id"]; ?>">Delete</a></td>
                </tr>
                <?php } ?>
                <!-- Add more rows for additional records -->
            </tbody>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Recipe Book</p>
    </footer>
</body>
</html>
