<?php
$conn = new mysqli("localhost", "root", "", "foodies_haven");
if (!isset($_POST['ingredients']) || !is_array($_POST['ingredients']) || count($_POST['ingredients'])==0) {
    echo "<div class='finder-results-section'><div class='finder-empty'>No ingredients selected.</div></div>";
    exit;
}
$ingredientIDs = array_map('intval', $_POST['ingredients']);
$in = implode(',', $ingredientIDs);

// Find recipes that use ALL the selected ingredients
$sql = "
SELECT r.*, 
       IFNULL(AVG(rt.rating), 0) AS avg_rating,
       COUNT(rt.id) AS total_ratings
FROM recipes r
JOIN recipe_ingredients ri ON r.id = ri.recipe_id
LEFT JOIN ratings rt ON r.id = rt.recipe_id
WHERE r.status='approved' AND ri.ingredient_id IN ($in)
GROUP BY r.id
HAVING COUNT(DISTINCT ri.ingredient_id) = ".count($ingredientIDs)."
ORDER BY avg_rating DESC, total_ratings DESC, r.name ASC
";
$res = $conn->query($sql);

echo "<div class='finder-results-section'>";
echo "<div class='finder-results-title'>Recipes using all selected ingredients</div>";
if ($res && $res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        ?>
        <div class="finder-recipe-card">
          <img class="finder-recipe-img" src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
          <div class="finder-recipe-content">
            <div class="finder-recipe-title"><?php echo htmlspecialchars($row['name']); ?></div>
            <div class="finder-recipe-rating">⭐ <?php echo number_format($row['avg_rating'],2); ?> (<?php echo $row['total_ratings']; ?> ratings)</div>
            <a class="finder-recipe-link" href="recipe.php?id=<?php echo $row['id']; ?>">View Recipe</a>
          </div>
        </div>
        <?php
    }
} else {
    echo "<div class='finder-empty'>No recipes found that use all selected ingredients.</div>";
}
echo "</div>";
?>