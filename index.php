<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Foodie's Haven</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navigation Bar -->
  <header class="navbar">
    <div class="navbar-left">
      <a href="index.php" class="navbar-logo">
        <!-- Optional logo image -->
        <!-- <img src="uploads/logo.png" alt="Foodie's Haven Logo" class="logo-img"> -->
        <span class="site-name">Foodie's Haven</span>
      </a>
    </div>
    <nav class="navbar-right">
      <a href="index.php" class="nav-btn">Home</a>
      <a href="recipe-finder.php" class="nav-btn">Recipe Finder</a>
      <a href="recipes.php" class="nav-btn">Recipes</a>
      <a href="login.php" class="nav-btn">Login</a>
    </nav>
  </header>

  <!-- Homepage Content -->
  <main class="homepage-content">
    <div class="home-header">
      <h1 class="main-title">Foodie's Haven</h1>
      <form class="search-bar" action="search.php" method="GET">
        <input type="text" name="q" placeholder="Search for recipes..." required>
        <button type="submit">Search</button>
      </form>
    </div>

    <!-- Top 5 Recipes Section -->
    <section class="top-recipes-section">
      <h2 class="section-title">Top 5 Recipes</h2>
      <div class="recipes-grid">
        <div class="recipe-card">
          <img src="uploads/recipe1.jpg" alt="Adobo" class="recipe-img">
          <div class="recipe-info">
            <h3>Chicken Adobo</h3>
            <p>Classic Filipino chicken stew braised in soy sauce and vinegar.</p>
            <a href="recipe.php?id=1" class="view-btn">View Recipe</a>
          </div>
        </div>
        <div class="recipe-card">
          <img src="uploads/recipe2.jpg" alt="Sinigang" class="recipe-img">
          <div class="recipe-info">
            <h3>Pork Sinigang</h3>
            <p>Sour tamarind soup with pork and assorted vegetables.</p>
            <a href="recipe.php?id=2" class="view-btn">View Recipe</a>
          </div>
        </div>
        <div class="recipe-card">
          <img src="uploads/recipe3.jpg" alt="Kare-Kare" class="recipe-img">
          <div class="recipe-info">
            <h3>Kare-Kare</h3>
            <p>Peanut stew with oxtail, vegetables, and savory peanut sauce.</p>
            <a href="recipe.php?id=3" class="view-btn">View Recipe</a>
          </div>
        </div>
        <div class="recipe-card">
          <img src="uploads/recipe4.jpg" alt="Lechon Kawali" class="recipe-img">
          <div class="recipe-info">
            <h3>Lechon Kawali</h3>
            <p>Crispy deep-fried pork belly, a Filipino favorite party dish.</p>
            <a href="recipe.php?id=4" class="view-btn">View Recipe</a>
          </div>
        </div>
        <div class="recipe-card">
          <img src="uploads/recipe5.jpg" alt="Pancit Canton" class="recipe-img">
          <div class="recipe-info">
            <h3>Pancit Canton</h3>
            <p>Stir-fried noodles with meat, shrimp, and mixed vegetables.</p>
            <a href="recipe.php?id=5" class="view-btn">View Recipe</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Reviews/Testimonials Section -->
    <section class="reviews-section">
      <h2 class="section-title">What Our Users Say</h2>
      <div class="reviews-grid">
        <div class="review-card">
          <img src="uploads/user1.jpg" alt="Maria" class="review-avatar">
          <div class="review-content">
            <h4>Maria L.</h4>
            <p>
              "Foodie's Haven helped me recreate my grandma's adobo! The step-by-step guides and beautiful pictures made cooking so much fun."
            </p>
          </div>
        </div>
        <div class="review-card">
          <img src="uploads/user2.jpg" alt="James" class="review-avatar">
          <div class="review-content">
            <h4>James D.</h4>
            <p>
              "I love the variety of Filipino dishes here. The search is super helpful and the recipes are easy to follow."
            </p>
          </div>
        </div>
        <div class="review-card">
          <img src="uploads/user3.jpg" alt="Aileen" class="review-avatar">
          <div class="review-content">
            <h4>Aileen P.</h4>
            <p>
              "This is my go-to site whenever I want to try something new. The top recipes list never disappoints!"
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>