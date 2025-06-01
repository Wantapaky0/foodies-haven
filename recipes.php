<?php
session_start();
$conn = new mysqli("localhost", "root", "", "foodies_haven");

// Fetch mealtimes and food types for filters
$mealtimes = [];
$res = $conn->query("SELECT * FROM mealtimes ORDER BY name ASC");
while ($row = $res->fetch_assoc()) $mealtimes[] = $row;

$foodtypes = [];
$res = $conn->query("SELECT * FROM food_types ORDER BY name ASC");
while ($row = $res->fetch_assoc()) $foodtypes[] = $row;

// Filtering
$filter_mealtime = isset($_GET['mealtime']) ? intval($_GET['mealtime']) : 0;
$filter_foodtype = isset($_GET['foodtype']) ? intval($_GET['foodtype']) : 0;

$where = [];
if ($filter_mealtime) $where[] = "recipes.mealtime_id = $filter_mealtime";
if ($filter_foodtype) $where[] = "recipes.food_type_id = $filter_foodtype";
$whereSQL = $where ? "WHERE " . implode(" AND ", $where) : "";

// Fetch recipes (with author and rating)
$sql = "
SELECT 
  recipes.id, recipes.name, recipes.user_id, 
  COALESCE(u.username, '') as username,
  IFNULL(avg(r.rating), 0) as avg_rating,
  COUNT(r.rating) as num_ratings
FROM recipes
LEFT JOIN users u ON recipes.user_id = u.id
LEFT JOIN ratings r ON recipes.id = r.recipe_id
$whereSQL
GROUP BY recipes.id
ORDER BY recipes.id DESC
";
$recipes = [];
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) $recipes[] = $row;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Browse Recipes - Foodie's Haven</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {margin:0;padding:0;background:#1a1a1f;}
  .navbar {background:#23283a;padding:1em 2em;display:flex;justify-content:space-between;align-items:center;}
  .navbar-left .site-name {font-size:1.3em;color:#fff;font-weight:bold;letter-spacing:1px;}
  .navbar-right .nav-btn {margin-left:1em;font-size:1em;color:#fff;text-decoration:none;opacity:.9;}
  .navbar-right .nav-active {color:#4db36f;font-weight:bold;}
  .recipes-page-wrap {
    max-width:1400px;
    margin:2em auto;
    display:flex;
    gap:2.5em;
    align-items:flex-start;
    padding:0 1em;
  }
  .recipes-filter-panel {
    width:220px;
    min-width:180px;
    background:rgba(44,48,70,0.98);
    border-radius:12px;
    padding:1.2em 1.3em;
    box-shadow:0 4px 22px #0002;
    color:#fff;
    font-size:1em;
    position:sticky; top:1.8em;
    height:max-content;
  }
  .recipes-filter-panel h3 {font-size:1.07em;margin:.6em 0 .4em 0;}
  .recipes-filter-list {
    padding:0;margin:0 0 1em 0;list-style:none;display:flex;flex-direction:column;gap:0.3em;
  }
  .recipes-filter-btn {
    background:#283040;color:#fff;
    border:none;border-radius:6px;cursor:pointer;
    font-size:1em;padding:0.5em 1em;text-align:left;
    transition:background .18s, color .16s;
    margin:0;
    display:block;width:100%;
  }
  .recipes-filter-btn.selected,
  .recipes-filter-btn:hover {background:#4db36f;color:#232323;}
  .recipes-reset-btn {
    background:#fae0d9;color:#cd2d22;
    border:none;border-radius:7px;font-size:.97em;
    padding:0.4em 1em;margin-top:1.3em;cursor:pointer;transition:background .18s;
    width:100%;
  }
  .recipes-reset-btn:hover {background:#fbc2b3;}

  .recipes-listing-main {flex:1;}
  .recipes-grid {
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:1.5em 1em;
    width:100%;
  }
  @media (max-width:1300px) {.recipes-grid{gap:1.1em;}}
  @media (max-width:1050px) {.recipes-grid{grid-template-columns:repeat(3,1fr);}}
  @media (max-width:800px)  {.recipes-grid{grid-template-columns:repeat(2,1fr);}}
  @media (max-width:500px)  {.recipes-grid{grid-template-columns:repeat(1,1fr);}}
  .recipe-card {
    background:#222330;
    border-radius:13px;
    box-shadow:0 2px 12px #0004;
    min-height:100px;
    height:110px;
    display:flex;align-items:center;justify-content:center;
    position:relative;
    overflow:hidden;
    cursor:pointer;
    transition:box-shadow .18s, transform .18s;
    will-change:transform;
  }
  .recipe-card:hover, .recipe-card:focus {
    box-shadow:0 8px 26px #0008;
    transform:translateY(-4px) scale(1.03);
    z-index:2;
  }
  /* Card content sliding in */
  .recipe-card-inner {
    position:absolute;
    left:0; top:0; width:100%; height:100%;
    display:flex;align-items:center;justify-content:center;
    transition:transform .39s cubic-bezier(.59,1.7,.38,1), opacity .22s;
    will-change:transform,opacity;
    transform:translateX(-108%);
    opacity:0;
    background:rgba(40,40,60,0.95);
    z-index:2;
    padding:0 1.1em;
  }
  .recipe-card:hover .recipe-card-inner,
  .recipe-card:focus .recipe-card-inner {
    transform:translateX(0%);
    opacity:1;
  }
  .recipe-card-title {
    font-size:1.1em;color:#fff;font-weight:bold;letter-spacing:.5px;text-align:center;
    text-shadow:0 1px 2px #0008;
    z-index:1;
    transition:opacity .18s;
    position:relative;
    padding:0 0.6em;
    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    max-width:98%;
  }
  .recipe-card:not(:hover):not(:focus) .recipe-card-title {
    opacity:1;
  }
  .recipe-card .recipe-card-title {opacity:1;}

  .recipe-card-info {
    display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.5em;
    width:100%;
  }
  .recipe-info-author {
    font-size:0.99em;color:#a7f0c4;text-align:center;
    margin:0;
  }
  .recipe-info-ratings {
    display:flex;align-items:center;gap:0.12em;
    font-size:1.25em;
    justify-content:center;
  }
  .star {
    color:#f5d96f;
    filter:drop-shadow(0 1px 2px #0007);
    opacity:0.85;
  }
  .star.dim {color:#555b69;opacity:0.5;}
  .recipe-card-link {position:absolute;inset:0;z-index:5;}
  </style>
</head>
<body>
<header class="navbar">
  <div class="navbar-left">
    <a href="index.php" class="navbar-logo">
      <span class="site-name">Foodie's Haven</span>
    </a>
  </div>
  <nav class="navbar-right">
    <a href="index.php" class="nav-btn">Home</a>
    <a href="recipe-finder.php" class="nav-btn">Recipe Finder</a>
    <a href="recipes.php" class="nav-btn nav-active">Recipes</a>
    <a href="login.php" class="nav-btn">Login</a>
  </nav>
</header>
<main>
  <div class="recipes-page-wrap">
    <!-- Filter Panel -->
    <aside class="recipes-filter-panel">
      <form method="get" id="filterForm">
        <h3>Mealtime</h3>
        <ul class="recipes-filter-list">
          <?php foreach($mealtimes as $mt): ?>
          <li>
            <button type="submit"
              name="mealtime"
              value="<?php echo $mt['id']?>"
              class="recipes-filter-btn<?php if($filter_mealtime==$mt['id']) echo ' selected'; ?>">
              <?php echo htmlspecialchars($mt['name']); ?>
            </button>
          </li>
          <?php endforeach; ?>
        </ul>
        <h3>Type of Food</h3>
        <ul class="recipes-filter-list">
          <?php foreach($foodtypes as $ft): ?>
          <li>
            <button type="submit"
              name="foodtype"
              value="<?php echo $ft['id']?>"
              class="recipes-filter-btn<?php if($filter_foodtype==$ft['id']) echo ' selected'; ?>">
              <?php echo htmlspecialchars($ft['name']); ?>
            </button>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php if($filter_mealtime || $filter_foodtype): ?>
          <button type="button" class="recipes-reset-btn" onclick="window.location.href='recipes.php'">Reset Filters</button>
        <?php endif; ?>
      </form>
    </aside>
    <!-- Recipes Grid -->
    <section class="recipes-listing-main">
      <div style="margin-bottom:1.1em;">
        <h1 style="color:#fff;margin:0 0 0.3em 0;font-size:1.7em;text-align:left;font-weight:bold;">All Recipes</h1>
      </div>
      <div class="recipes-grid">
        <?php if(count($recipes)==0): ?>
          <div style="color:#fff;font-size:1.1em;text-align:center;grid-column:span 5;">
            No recipes found for your filter!
          </div>
        <?php else: foreach($recipes as $r): ?>
          <div class="recipe-card" tabindex="0">
            <span class="recipe-card-title"><?php echo htmlspecialchars($r['name']); ?></span>
            <div class="recipe-card-inner">
              <div class="recipe-card-info">
                <div class="recipe-card-title" style="font-size:1.23em;line-height:1.3;max-width:100%;">
                  <?php echo htmlspecialchars($r['name']); ?>
                </div>
                <div class="recipe-info-ratings" aria-label="Rating: <?php echo round($r['avg_rating'],1); ?> stars">
                  <?php
                    $stars = round($r['avg_rating']);
                    for($i=1;$i<=5;$i++)
                      echo '<span class="star'.($i>$stars?' dim':'').'">&#9733;</span>';
                  ?>
                  <span style="font-size:.98em;color:#aaa;margin-left:.5em;"><?php echo number_format($r['avg_rating'],1); ?>/5</span>
                </div>
                <div class="recipe-info-author">
                  <?php
                    if(empty($r['username']))
                      echo "by Foodie's Haven";
                    else
                      echo "by " . htmlspecialchars($r['username']);
                  ?>
                </div>
              </div>
            </div>
            <a href="recipe.php?id=<?php echo $r['id']; ?>" class="recipe-card-link" tabindex="-1"></a>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </section>
  </div>
</main>
<script>
// Only allow one filter selection per mealtime/type, form submits instantly
document.querySelectorAll('.recipes-filter-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    // allow native submit
  });
});
</script>
</body>
</html>