<?php
session_start();
$conn = new mysqli("localhost", "root", "", "foodies_haven");

// Get mealtime and food type options (you can adjust/add more as needed)
$mealtimes = [
  "Breakfast", "Lunch", "Dinner", "Snack", "Brunch", "Midnight Snack"
];
$foodtypes = [
  "Main Dish", "Appetizer", "Soup", "Salad", "Dessert", "Snack", "Beverage", "Side Dish"
];

// Get ingredient categories and their ingredients
$catQ = $conn->query("SELECT * FROM ingredient_categories ORDER BY name ASC");
$categories = [];
while ($cat = $catQ->fetch_assoc()) {
    $cat['ingredients'] = [];
    $categories[$cat['id']] = $cat;
}
$ingQ = $conn->query("SELECT * FROM ingredients ORDER BY name ASC");
while ($ing = $ingQ->fetch_assoc()) {
    $categories[$ing['category_id']]['ingredients'][] = $ing;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recipe Finder - Foodie's Haven</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .finder-container {
      max-width:900px;
      margin:2em auto;
      background:rgba(35,35,35,0.68);
      border-radius:12px;
      padding:2em;
      box-shadow:0 4px 32px #0008;
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border:1.5px solid rgba(255,255,255,0.10);
    }
    /* --- FLEX CENTERED GRID FOR ALL PICKERS --- */
    .picker-list {
      margin:0 0 1em 0;padding:0;list-style:none;
      display:flex;flex-wrap:wrap;gap:0.7em 1.1em;justify-content:center;align-items:center;
      width:100%;
    }
    .picker-btn {
      background:#283040;color:#fff;
      font-size:1em;
      padding:0.6em 1.3em;
      border:none;outline:none;
      cursor:pointer;
      transition:background 0.18s, color 0.18s;
      border-radius:6px;
      box-shadow:0 1px 2px #0002;
      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
      display:inline-flex;align-items:center;justify-content:center;
      min-width:210px;max-width:350px;width:210px;
      height:2.35em;
      text-align:center;
      position:relative;
    }
    .picker-btn.selected {
      background:#4db36f;color:#232323;font-weight:bold;
    }
    .picker-btn.selected::after {
      content:'✔';font-size:1.15em;margin-left:0.5em;display:inline-block;color:#fff;
      background: #3a974d; border-radius:50%;width:1.3em;height:1.3em;line-height:1.3em;text-align:center;
      box-shadow:0 1px 3px #0002;vertical-align:middle;
      position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    }
    .picker-btn:hover, .picker-btn:focus {
      background:#fff;
      color:#232323;
    }
    /* --- CATEGORY FLEX CENTERED GRID --- */
    .category-list {
      margin:0;padding:0;list-style:none;
      display:flex;flex-wrap:wrap;gap:0.7em 1.1em;justify-content:center;align-items:center;
      width:100%;
    }
    .category-btn {
      background:#283040;color:#fff;
      font-size:1em;
      padding:0.6em 1.3em;
      border:none;outline:none;
      cursor:pointer;
      transition:background 0.18s, color 0.18s;
      border-radius:6px;
      box-shadow:0 1px 2px #0002;
      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
      display:inline-flex;align-items:center;justify-content:center;
      min-width:210px;max-width:350px;width:210px;
      height:2.35em;
      text-align:center;
      position:relative;
    }
    .category-btn[aria-expanded="true"] {background:#364058;}
    .category-btn .arrow {transition:transform 0.3s;font-size:1em;margin-left:0.7em;}
    .category-btn[aria-expanded="true"] .arrow {transform:rotate(90deg);}
    .category-btn:hover, .category-btn:focus {
      background:#fff;
      color:#232323;
    }
    /* --- INGREDIENTS PANEL --- */
    .ingredients-panel {
      max-height:0;
      overflow:hidden;
      transition:max-height 0.5s cubic-bezier(0.4,0,0.2,1),padding 0.3s;
      background:#23283a;
      margin-bottom:0.6em;
      border-radius:8px;
      padding:0 0.7em;
      box-shadow:0 2px 8px #0002;position:relative;z-index:2;
      /* FLEX GRID CENTERED */
      display:flex;flex-wrap:wrap;gap:0.6em 1.1em;justify-content:center;align-items:center;
      width:100%;
    }
    .ingredients-panel.open {
      padding:0.6em 0.7em 1em 0.7em;
      max-height:300px;
      overflow-y:auto;
      box-shadow:0 6px 16px #0005;
      margin-bottom:0.8em;
      scrollbar-width:thin;
      scrollbar-color:#3b4252 #23283a;
    }
    .ingredients-panel.open::-webkit-scrollbar {
      width:8px;
      background:#23283a;
    }
    .ingredients-panel.open::-webkit-scrollbar-thumb {
      background:#3b4252;
      border-radius:5px;
    }
    /* --- INGREDIENT BUTTONS FLEX GRID CENTERED --- */
    .ingredient-btn {
      background:#495480;
      color:#c6c6c6;
      border:none;
      border-radius:6px;
      font-size:1em;
      cursor:pointer;
      transition:
        background .17s, color .17s,
        box-shadow .14s,
        z-index 0.18s;
      box-shadow:0 1px 3px #0001;
      white-space:nowrap;
      overflow:hidden;
      text-overflow:ellipsis;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      min-width:210px;max-width:350px;width:210px;
      height:2.35em;
      text-align:center;
      position:relative;
      z-index:0;
    }
    .ingredient-btn:hover, .ingredient-btn:focus {
      color:#232323;
      background:#fff;
      z-index:10;
      width:350px;
      min-width:350px;
      max-width:350px;
      overflow:visible;
    }
    .ingredient-btn.selected {
      background:#4db36f;color:#232323;
      font-weight:bold;position:relative;
    }
    .ingredient-btn.selected::after {
      content:'✔';font-size:1.15em;margin-left:0.5em;display:inline-block;color:#fff;
      background: #3a974d; border-radius:50%;width:1.3em;height:1.3em;line-height:1.3em;text-align:center;
      box-shadow:0 1px 3px #0002;vertical-align:middle;
      position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    }
    @keyframes popCheck {
      0% {transform:scale(0.4) translateY(-50%);}
      80%{transform:scale(1.25) translateY(-50%);}
      100%{transform:scale(1) translateY(-50%);}
    }
    .chosen-list {
      margin:1.4em 0 0.6em 0;padding:0;list-style:none;display:flex;flex-wrap:wrap;gap:0.3em;min-height:36px;justify-content:center;align-items:center;
    }
    .chosen-item {
      background:#4db36f;color:#fff;padding:0.32em 1.1em 0.32em 0.8em;
      font-size:0.97em;border-radius:9px;
      display:flex;align-items:center;transition:background .15s;
      position:relative;box-shadow:0 1px 3px #0002;
    }
    .chosen-item .remove-x {
      display:inline-block;width:18px;height:18px;
      border-radius:50%;margin-left:0.3em;
      background:#fff3;color:#fff;cursor:pointer;
      font-weight:bold;font-size:1.1em;line-height:1.1em;text-align:center;
      opacity:0;transition:opacity 0.2s, background 0.2s;
    }
    .chosen-item:hover .remove-x {opacity:1;background:#b83a4b;}
    .finder-search-btn {
      display:block;width:100%;max-width:340px;margin:1.7em auto 1em auto;
      padding:0.8em 0;font-size:1.18em;background:#f46949;color:#fff;
      border:none;border-radius:10px;
      box-shadow:0 2px 10px #0005;
      cursor:pointer;letter-spacing:1px;font-weight:bold;transition:background 0.2s;
    }
    .finder-search-btn:active {background:#d35a3b;}
    .finder-results-section {background:#202024;margin:1.5em auto 0 auto;border-radius:12px;max-width:700px;box-shadow:0 1px 10px #0002;padding:1.2em;}
    .finder-results-title {color:#fff;font-size:1.2em;font-weight:bold;margin-bottom:0.6em;}
    .finder-empty {color:#aaa;font-size:1.07em;text-align:center;}
    .finder-recipe-card {
      background:#333b45;border-radius:9px;box-shadow:0 1px 5px #0002;
      margin-bottom:1em;padding:1em;display:flex;gap:1.2em;align-items:center;
    }
    .finder-recipe-img {width:75px;height:75px;object-fit:cover;border-radius:8px;}
    .finder-recipe-content {flex:1;}
    .finder-recipe-title {margin:0 0 0.2em 0;color:#fff;font-size:1.13em;}
    .finder-recipe-rating {font-size:0.97em;color:#f4d96f;}
    .finder-recipe-link {color:#4db36f;text-decoration:none;font-weight:bold;font-size:1em;}
    @media (max-width:900px) {.finder-container{padding:1em;}}
    @media (max-width:600px) {
      .finder-container {padding:0.5em;}
      .picker-list, .category-list {gap:0.28em 0.3em;}
      .picker-btn, .category-btn, .ingredient-btn, .ingredient-btn:hover, .ingredient-btn:focus {
        min-width:99vw !important;
        max-width:99vw !important;
        width:99vw !important;
        font-size:1em;
      }
    }
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
      <a href="recipe-finder.php" class="nav-btn nav-active">Recipe Finder</a>
      <a href="recipes.php" class="nav-btn">Recipes</a>
      <a href="login.php" class="nav-btn">Login</a>
    </nav>
</header>
<main>
  <div class="finder-container">
    <h1 style="text-align:center;color:#fff;margin-bottom:1em;">Recipe Finder</h1>
    <div style="margin-bottom:1.3em;">
      <div style="color:#fff;text-align:center;margin-bottom:0.5em;font-size:1.06em;">Filter by Mealtime</div>
      <ul class="picker-list" id="mealtime-list">
        <?php foreach($mealtimes as $mealtime): ?>
          <li>
            <button class="picker-btn" data-picker-type="mealtime" data-picker-value="<?php echo htmlspecialchars($mealtime); ?>">
              <?php echo htmlspecialchars($mealtime); ?>
            </button>
          </li>
        <?php endforeach; ?>
      </ul>
      <div style="color:#fff;text-align:center;margin-bottom:0.5em;font-size:1.06em;">Filter by Type of Food</div>
      <ul class="picker-list" id="foodtype-list">
        <?php foreach($foodtypes as $foodtype): ?>
          <li>
            <button class="picker-btn" data-picker-type="foodtype" data-picker-value="<?php echo htmlspecialchars($foodtype); ?>">
              <?php echo htmlspecialchars($foodtype); ?>
            </button>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <ul class="category-list" id="category-list">
      <?php foreach($categories as $cat): ?>
        <?php if(count($cat['ingredients']) == 0) continue; ?>
        <li>
          <button class="category-btn" aria-expanded="false" data-cat="<?php echo $cat['id']; ?>">
            <?php echo htmlspecialchars($cat['name']); ?>
            <span class="arrow">&#9654;</span>
          </button>
          <div class="ingredients-panel" data-cat="<?php echo $cat['id']; ?>">
            <?php foreach($cat['ingredients'] as $ing): ?>
              <button class="ingredient-btn" data-ing-id="<?php echo $ing['id']; ?>" data-ing-name="<?php echo htmlspecialchars($ing['name']); ?>">
                <?php echo htmlspecialchars($ing['name']); ?>
              </button>
            <?php endforeach; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <ul class="chosen-list" id="chosen-list"></ul>
    <button class="finder-search-btn" id="finder-search-btn" disabled>Search for Recipe!</button>
    <div id="finder-results"></div>
  </div>
</main>
<script>
const catBtns = document.querySelectorAll('.category-btn');
let openPanel = null;

// Category open/close logic
catBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    const catId = btn.getAttribute('data-cat');
    const panel = document.querySelector('.ingredients-panel[data-cat="'+catId+'"]');
    if (openPanel && openPanel !== panel) {
      openPanel.classList.remove('open');
      openPanel.previousElementSibling.setAttribute('aria-expanded', 'false');
    }
    if (panel.classList.contains('open')) {
      panel.classList.remove('open');
      btn.setAttribute('aria-expanded', 'false');
      openPanel = null;
    } else {
      panel.classList.add('open');
      btn.setAttribute('aria-expanded', 'true');
      openPanel = panel;
    }
  });
});

// Ingredient selection logic
const ingBtns = document.querySelectorAll('.ingredient-btn');
const chosenList = document.getElementById('chosen-list');
const searchBtn = document.getElementById('finder-search-btn');
const resultsDiv = document.getElementById('finder-results');
let chosenIngredients = [];

// Mealtime and Foodtype picker logic
const pickerBtns = document.querySelectorAll('.picker-btn');
let selectedMealtime = null;
let selectedFoodtype = null;

pickerBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    const type = btn.getAttribute('data-picker-type');
    const value = btn.getAttribute('data-picker-value');
    if (type === "mealtime") {
      document.querySelectorAll('.picker-btn[data-picker-type="mealtime"]').forEach(b => b.classList.remove('selected'));
      if (selectedMealtime === value) {
        selectedMealtime = null;
      } else {
        btn.classList.add('selected');
        selectedMealtime = value;
      }
    } else if (type === "foodtype") {
      document.querySelectorAll('.picker-btn[data-picker-type="foodtype"]').forEach(b => b.classList.remove('selected'));
      if (selectedFoodtype === value) {
        selectedFoodtype = null;
      } else {
        btn.classList.add('selected');
        selectedFoodtype = value;
      }
    }
  });
});

function refreshChosenList() {
  chosenList.innerHTML = '';
  chosenIngredients.forEach(obj => {
    const li = document.createElement('li');
    li.className = 'chosen-item';
    li.textContent = obj.name;
    const x = document.createElement('span');
    x.className = 'remove-x';
    x.textContent = '×';
    x.title = 'Remove';
    x.onclick = () => {
      chosenIngredients = chosenIngredients.filter(i => i.id !== obj.id);
      document.querySelector('.ingredient-btn[data-ing-id="'+obj.id+'"]').classList.remove('selected');
      refreshChosenList();
    };
    li.appendChild(x);
    chosenList.appendChild(li);
  });
  searchBtn.disabled = chosenIngredients.length === 0 && !selectedMealtime && !selectedFoodtype;
}

ingBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    const id = parseInt(btn.getAttribute('data-ing-id'));
    const name = btn.getAttribute('data-ing-name');
    if (btn.classList.contains('selected')) {
      btn.classList.remove('selected');
      chosenIngredients = chosenIngredients.filter(i => i.id !== id);
    } else {
      btn.classList.add('selected');
      if (!chosenIngredients.some(i => i.id === id))
        chosenIngredients.push({id, name});
    }
    refreshChosenList();
  });
});

// Search results (AJAX)
searchBtn.addEventListener('click', () => {
  resultsDiv.innerHTML = "<div class='finder-results-section'><div class='finder-results-title'>Searching...</div></div>";
  const params = [];
  if (chosenIngredients.length) params.push(...chosenIngredients.map(i=>'ingredients[]='+encodeURIComponent(i.id)));
  if (selectedMealtime) params.push('mealtime='+encodeURIComponent(selectedMealtime));
  if (selectedFoodtype) params.push('foodtype='+encodeURIComponent(selectedFoodtype));
  fetch('search-recipes.php',{
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: params.join('&')
  })
  .then(res=>res.text())
  .then(html=>{
    resultsDiv.innerHTML = html;
    window.scrollTo({top: resultsDiv.getBoundingClientRect().top + window.scrollY - 80, behavior:'smooth'});
  });
});

// Update search button enable state on picker change
pickerBtns.forEach(btn => {
  btn.addEventListener('click', refreshChosenList);
});
</script>
</body>
</html>