<section>    
        <form action="#" method="post" id="createRecipeFormPrimaryInfo">
                <h2>Recipe Ingredients</h2>
                <label for="recipeIngredient">Ingredient:</label>
                <select id="recipeIngredient" name="recipeIngredient" required>
                    <option value="--">-- Select Ingredient --</option>

                    <?php
                        $queryIng = "SELECT ingredient_id, ingredient_name FROM ingredient";
                        $result = mysqli_query($connection, $queryIng); 
                    ?>
                    <?php while($result_set = mysqli_fetch_array($result)){ ?>
                    <option value="<?php echo $result_set["ingredient_id"]; ?>"><?php echo $result_set["ingredient_name"]; ?></option>
                    <?php } ?>
                    
                </select>
    
                <label for="recipeIngredientValue">Quantity:</label>
                <input type="number" id="recipeIngredientValue" name="recipeIngredientValue" required>
                <?php
                        $queryUnit = "SELECT unit_id, unit_name FROM unit";
                        $result = mysqli_query($connection, $queryUnit); 
                    ?>
                <label for="ingredientUnitSelect">Select Unit:</label>
                <select id="ingredientUnitSelect" name="unitID">
                    <option value="--"> -- Choose a Unit -- </option>
                    <?php while($result_set = mysqli_fetch_array($result)){ ?>
                    <option value="<?php echo $result_set["unit_id"]; ?>"><?php echo $result_set["unit_name"]; ?></option>
                    <?php } ?>
                </select>
    
                <label for="comments">Additional Comments:</label>
                <textarea id="comments" name="comments" rows="4"></textarea>
                <button type="submit" name="add_more_ingredients" value="addMore">Add more Ingredient</button>
                <button type="submit" name="submit_recipe" value="submitRecipe">Finish Recipe</button>
        </form>
    </section>