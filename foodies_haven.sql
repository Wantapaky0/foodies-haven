-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 11:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodies_haven`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Dessert'),
(1, 'Main Dish'),
(4, 'Snack'),
(2, 'Soup');

-- --------------------------------------------------------

--
-- Table structure for table `food_types`
--

CREATE TABLE `food_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_types`
--

INSERT INTO `food_types` (`id`, `name`) VALUES
(2, 'Appetizer'),
(7, 'Beverage'),
(5, 'Dessert'),
(1, 'Main Dish'),
(4, 'Salad'),
(8, 'Side Dish'),
(6, 'Snack'),
(3, 'Soup');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `category_id`) VALUES
(1, 'Black Pepper (Paminta) – whole or ground', 1),
(2, 'White Pepper – ground', 1),
(3, 'Salt (Asin) – iodized, rock, sea', 1),
(4, 'Chili Powder (Siling pulbos) – ground', 1),
(5, 'Paprika – sweet, smoked', 1),
(6, 'Cayenne – ground', 1),
(7, 'Cumin (Kumin) – whole or ground', 1),
(8, 'Coriander Seeds (Buto ng kulantro) – whole or ground', 1),
(9, 'Turmeric (Luyang dilaw) – fresh or ground', 1),
(10, 'Cinnamon (Kanela) – stick or ground', 1),
(11, 'Cloves (Clavo) – whole or ground', 1),
(12, 'Cardamom – whole or ground', 1),
(13, 'Star Anise (Anis estrellado) – whole', 1),
(14, 'Nutmeg (Myristika) – ground', 1),
(15, 'Allspice – ground', 1),
(16, 'Fennel Seeds – whole', 1),
(17, 'Mustard Seeds – yellow or brown', 1),
(18, 'Fenugreek – seeds or ground', 1),
(19, 'Curry Powder – blend', 1),
(20, 'Garam Masala – blend', 1),
(21, 'Italian Seasoning – blend', 1),
(22, 'Chinese Five Spice – blend', 1),
(23, 'Onion Powder (Sibuyas powder) – ground', 1),
(24, 'Garlic Powder (Bawang powder) – ground', 1),
(25, 'MSG / Vetsin – powder', 1),
(26, 'Seasoning Mix (e.g., Magic Sarap, NamNam) – blend', 1),
(27, 'Bouillon Cubes (Knorr, Maggi) – beef, pork, chicken', 1),
(28, 'Garlic (Bawang) – fresh', 2),
(29, 'Onion (Sibuyas) – red, white', 2),
(30, 'Shallots (Sibuyas Tagalog) – fresh', 2),
(31, 'Ginger (Luya) – fresh', 2),
(32, 'Turmeric Root (Luyang dilaw) – fresh', 2),
(33, 'Lemongrass (Tanglad) – stalk', 2),
(34, 'Green Onion / Scallion (Dahon ng sibuyas) – fresh', 2),
(35, 'Leeks – fresh', 2),
(36, 'Celery (Selery) – stalk', 2),
(37, 'Bell Pepper (Siling pangsigang) – green, red, yellow', 2),
(38, 'Chili (Siling labuyo, Siling haba) – fresh', 2),
(39, 'Cilantro / Coriander Leaves (Wansoy) – fresh', 2),
(40, 'Parsley – fresh or dried', 2),
(41, 'Basil (Balanoi) – fresh or dried', 2),
(42, 'Oregano – fresh or dried', 2),
(43, 'Mint (Yerba buena) – fresh', 2),
(44, 'Thyme – fresh or dried', 2),
(45, 'Rosemary – fresh or dried', 2),
(46, 'Sage – fresh or dried', 2),
(47, 'Dill – fresh', 2),
(48, 'Bay Leaf (Dahon ng laurel) – dried', 2),
(49, 'Marjoram – dried', 2),
(50, 'Tarragon – dried', 2),
(51, 'Chicken (Manok) – whole, breast, thigh, wings', 3),
(52, 'Pork (Baboy) – belly, chops, ground, ribs', 3),
(53, 'Beef (Baka) – ground, brisket, steak, stew cuts', 3),
(54, 'Carabao (Kalabaw) – rural meat option', 3),
(55, 'Duck (Pato) – whole or cut', 3),
(56, 'Turkey – imported, frozen', 3),
(57, 'Sausages – local (longganisa), hotdogs', 3),
(58, 'Tocino – sweet cured pork', 3),
(59, 'Tapa – marinated beef', 3),
(60, 'Corned Beef – canned', 3),
(61, 'Ham (Hamon) – fresh, cooked, smoked', 3),
(62, 'Bacon – smoked, sliced', 3),
(63, 'Embutido – Filipino-style meatloaf', 3),
(64, 'Milkfish (Bangus) – fresh, boneless', 4),
(65, 'Tilapia – fresh or whole', 4),
(66, 'Galunggong (Round Scad) – fresh', 4),
(67, 'Tuna – fresh or canned', 4),
(68, 'Salmon – fresh or frozen', 4),
(69, 'Sardines – fresh or canned', 4),
(70, 'Anchovies (Dilis) – fresh, dried', 4),
(71, 'Smoked Fish (Tinapa) – whole', 4),
(72, 'Dried Fish (Tuyo, Daing) – salted, dried', 4),
(73, 'Shrimp (Hipon) – fresh or frozen', 4),
(74, 'Squid (Pusit) – fresh', 4),
(75, 'Mussels (Tahong) – fresh or frozen', 4),
(76, 'Clams (Halaan) – fresh', 4),
(77, 'Crab (Alimasag) – fresh', 4),
(78, 'Eggs (Itlog) – chicken, duck (balut, penoy)', 5),
(79, 'Milk – fresh, powdered, evaporated, condensed', 5),
(80, 'Evaporated Milk (Gatas na evap) – canned', 5),
(81, 'Condensed Milk (Gatas na condensada) – canned', 5),
(82, 'Cheese (Keso) – cheddar, quickmelt, processed (Eden)', 5),
(83, 'Cream – Nestlé all-purpose, heavy', 5),
(84, 'Butter – salted, unsalted', 5),
(85, 'Margarine – local brands', 5),
(86, 'Yogurt – plain, flavored', 5),
(87, 'Buttermilk – rare, DIY from milk + vinegar', 5),
(88, 'Gatas ng Niyog (Coconut Milk/Cream) – fresh or canned', 5),
(89, 'White Rice (Bigas/Kanin) – jasmine, sinandomeng', 6),
(90, 'Brown Rice – whole grain', 6),
(91, 'Glutinous Rice (Malagkit) – for kakanin', 6),
(92, 'Corn (Mais) – kernels or flour', 6),
(93, 'Oats – rolled or instant', 6),
(94, 'Bread – loaf, pandesal', 6),
(95, 'Crackers – Skyflakes, Marie, Fita', 6),
(96, 'Pasta – spaghetti, macaroni, penne', 6),
(97, 'Flour – all-purpose, bread, rice flour', 6),
(98, 'Pancake Mix – local and imported', 6),
(99, 'Noodles – bihon, canton, miki, sotanghon', 6),
(100, 'Instant Noodles – various flavors', 6),
(101, 'Cereal – cornflakes, oats', 6),
(102, 'Mung Beans (Munggo) – whole', 7),
(103, 'Kidney Beans – canned or dried', 7),
(104, 'Black Beans – canned', 7),
(105, 'White Beans – dried or canned', 7),
(106, 'Chickpeas (Garbanzos) – canned or dried', 7),
(107, 'Green Peas – canned or frozen', 7),
(108, 'Soybeans – dried', 7),
(109, 'Tofu (Tokwa) – firm or soft', 7),
(110, 'Tempeh – less common', 7),
(111, 'Taho – silken tofu', 7),
(112, 'Split Peas – yellow or green', 7),
(113, 'Eggplant (Talong) – long purple', 8),
(114, 'Bitter Melon (Ampalaya) – sliced', 8),
(115, 'String Beans (Sitaw) – long', 8),
(116, 'Winged Beans (Sigarilyas)', 8),
(117, 'Squash (Kalabasa) – chopped', 8),
(118, 'Okra – whole', 8),
(119, 'Tomato (Kamatis) – fresh', 8),
(120, 'Potato (Patatas) – white', 8),
(121, 'Sweet Potato (Kamote)', 8),
(122, 'Taro Root (Gabi) – peeled', 8),
(123, 'Chayote (Sayote)', 8),
(124, 'Malunggay (Moringa Leaves) – fresh', 8),
(125, 'Pechay (Bok Choy) – native variety', 8),
(126, 'Mustard Greens (Mustasa) – leafy', 8),
(127, 'Kangkong (Water Spinach) – fresh', 8),
(128, 'Cabbage (Repolyo) – chopped', 8),
(129, 'Carrots (Karot) – sliced or shredded', 8),
(130, 'Bottle Gourd (Upo) – peeled', 8),
(131, 'Radish (Labanos) – white', 8),
(132, 'Lettuce – iceberg, romaine', 8),
(133, 'Arugula – fresh', 8),
(134, 'Zucchini – sliced', 8),
(135, 'Broccoli – florets', 8),
(136, 'Cauliflower – florets', 8),
(137, 'Spinach – fresh', 8),
(138, 'Banana (Saging) – saba, lakatan, latundan', 9),
(139, 'Mango (Mangga) – ripe or green', 9),
(140, 'Pineapple (Pinya) – fresh or canned', 9),
(141, 'Papaya – ripe or green', 9),
(142, 'Avocado – fresh', 9),
(143, 'Calamansi – citrus', 9),
(144, 'Lemon – fresh', 9),
(145, 'Orange (Kahel) – imported', 9),
(146, 'Watermelon (Pakwan)', 9),
(147, 'Apple – red, green', 9),
(148, 'Grapes – red, green', 9),
(149, 'Jackfruit (Langka) – fresh or canned', 9),
(150, 'Coconut (Niyog) – grated, juice, meat', 9),
(151, 'Melon (Cantaloupe)', 9),
(152, 'Guava (Bayabas)', 9),
(153, 'Starfruit (Balimbing)', 9),
(154, 'Santol, Duhat, Rambutan – seasonal', 9),
(155, 'Canned Tuna – flakes in oil or brine', 10),
(156, 'Canned Sardines – in tomato sauce', 10),
(157, 'Luncheon Meat (Spam, Maling) – canned', 10),
(158, 'Vienna Sausage – canned', 10),
(159, 'Baked Beans – canned', 10),
(160, 'Coconut Milk (Gata) – canned or fresh', 10),
(161, 'Evaporated/Condensed Milk – canned', 10),
(162, 'Tomato Sauce – canned', 10),
(163, 'Tomato Paste – canned', 10),
(164, 'Pickles – cucumber, relish', 10),
(165, 'Atchara (Pickled Papaya) – bottled', 10),
(166, 'Peanut Butter – local and imported', 10),
(167, 'Fruit Jam – mango, pineapple, strawberry', 10),
(168, 'Cheese Spread – for pandesal', 10),
(169, 'Soy Sauce (Toyo) – dark, light', 11),
(170, 'Vinegar (Suka) – cane, coconut, white', 11),
(171, 'Fish Sauce (Patis) – bottled', 11),
(172, 'Banana Ketchup – sweet', 11),
(173, 'Tomato Ketchup – local or imported', 11),
(174, 'Hot Sauce – labuyo-based, Tabasco', 11),
(175, 'Oyster Sauce – bottled', 11),
(176, 'Hoisin Sauce – Chinese cuisine', 11),
(177, 'Worcestershire Sauce – bottled', 11),
(178, 'Barbecue Sauce – sweet style', 11),
(179, 'Mayonnaise – Lady’s Choice, Best Foods', 11),
(180, 'Mustard – yellow, Dijon', 11),
(181, 'Peanut Sauce – for kare-kare', 11),
(182, 'Bagoong – shrimp or fish paste', 11),
(183, 'Vegetable Oil – palm, soy', 12),
(184, 'Canola Oil – neutral', 12),
(185, 'Coconut Oil – local', 12),
(186, 'Olive Oil – extra virgin or regular', 12),
(187, 'Sesame Oil – toasted', 12),
(188, 'Margarine – for cooking or spreading', 12),
(189, 'Lard – traditional fat', 12),
(190, 'Ghee – clarified butter', 12),
(191, 'All-Purpose Flour – local or imported', 13),
(192, 'Cake Flour – soft baked goods', 13),
(193, 'Bread Flour – chewy baked goods', 13),
(194, 'Rice Flour – kakanin', 13),
(195, 'Glutinous Rice Flour – suman, biko', 13),
(196, 'Cornstarch – thickener', 13),
(197, 'Baking Powder – leavening', 13),
(198, 'Baking Soda – leavening', 13),
(199, 'Yeast – active dry or instant', 13),
(200, 'Sugar – white, brown, muscovado', 13),
(201, 'Honey – local or imported', 13),
(202, 'Molasses – dark sweetener', 13),
(203, 'Cocoa Powder – for baking', 13),
(204, 'Chocolate Chips – semi-sweet or milk', 13),
(205, 'Vanilla Extract – pure or imitation', 13),
(206, 'Gelatin – gulaman bars, powder', 13),
(207, 'Food Coloring – liquid or gel', 13);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_categories`
--

CREATE TABLE `ingredient_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_categories`
--

INSERT INTO `ingredient_categories` (`id`, `name`) VALUES
(2, 'Aromatics & Herbs'),
(13, 'Baking & Pantry Staples'),
(10, 'Canned & Jarred Goods'),
(11, 'Condiments & Sauces'),
(5, 'Dairy & Eggs'),
(9, 'Fruits'),
(6, 'Grains & Grain Products'),
(7, 'Legumes & Pulses'),
(3, 'Meat & Poultry'),
(12, 'Oils & Fats'),
(4, 'Seafood'),
(1, 'Spices & Seasonings'),
(8, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `mealtimes`
--

CREATE TABLE `mealtimes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mealtimes`
--

INSERT INTO `mealtimes` (`id`, `name`) VALUES
(1, 'Breakfast'),
(5, 'Brunch'),
(3, 'Dinner'),
(2, 'Lunch'),
(6, 'Midnight Snack'),
(4, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `recipe_id`, `user_id`, `rating`, `review`, `created_at`) VALUES
(1, 1, 2, 5, 'Delicious and easy to cook!', '2025-05-29 11:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mealtime_id` int(11) DEFAULT NULL,
  `food_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `name`, `description`, `image`, `video`, `category_id`, `created_by`, `status`, `created_at`, `mealtime_id`, `food_type_id`) VALUES
(1, 'Chicken Adobo', 'Classic Filipino chicken braised in soy sauce and vinegar.', 'uploads/recipe1.jpg', NULL, 1, 1, 'approved', '2025-05-29 11:36:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_comments`
--

CREATE TABLE `recipe_comments` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_comments`
--

INSERT INTO `recipe_comments` (`id`, `recipe_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 2, 'My family loved it!', '2025-05-29 11:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_images`
--

CREATE TABLE `recipe_images` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `amount` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_id`, `amount`) VALUES
(1, 1, 28, '5 cloves'),
(2, 1, 29, '1 medium'),
(3, 1, 53, '1 kg'),
(4, 1, 82, '1/2 cup'),
(5, 1, 96, '1/2 cup'),
(6, 1, 3, '1 tsp');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `step_number` int(11) NOT NULL,
  `instruction` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_steps`
--

INSERT INTO `recipe_steps` (`id`, `recipe_id`, `step_number`, `instruction`, `image`, `video`) VALUES
(1, 1, 1, 'Marinate chicken in soy sauce, vinegar, garlic, and pepper for 30 minutes.', NULL, NULL),
(2, 1, 2, 'Saute garlic and onions, add marinated chicken, cook until lightly browned.', NULL, NULL),
(3, 1, 3, 'Pour in marinade, add water if needed, simmer until chicken is tender.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_videos`
--

CREATE TABLE `recipe_videos` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `video_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `email`, `profile_pic`, `bio`, `role`, `created_at`) VALUES
(1, 'admin', 'hashedpassword', 'Admin User', 'admin@email.com', 'uploads/admin.jpg', 'Site administrator', 'admin', '2025-05-29 11:36:52'),
(2, 'user1', 'hashedpassword', 'Juan Dela Cruz', 'juan@email.com', 'uploads/juan.jpg', 'Food lover', 'user', '2025-05-29 11:36:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `food_types`
--
ALTER TABLE `food_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `ingredient_categories`
--
ALTER TABLE `ingredient_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `mealtimes`
--
ALTER TABLE `mealtimes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recipe_id` (`recipe_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `fk_mealtime` (`mealtime_id`),
  ADD KEY `fk_foodtype` (`food_type_id`);

--
-- Indexes for table `recipe_comments`
--
ALTER TABLE `recipe_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `recipe_images`
--
ALTER TABLE `recipe_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `food_types`
--
ALTER TABLE `food_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `ingredient_categories`
--
ALTER TABLE `ingredient_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mealtimes`
--
ALTER TABLE `mealtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipe_comments`
--
ALTER TABLE `recipe_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipe_images`
--
ALTER TABLE `recipe_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `ingredient_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_foodtype` FOREIGN KEY (`food_type_id`) REFERENCES `food_types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_mealtime` FOREIGN KEY (`mealtime_id`) REFERENCES `mealtimes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `recipe_comments`
--
ALTER TABLE `recipe_comments`
  ADD CONSTRAINT `recipe_comments_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_images`
--
ALTER TABLE `recipe_images`
  ADD CONSTRAINT `recipe_images_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recipe_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD CONSTRAINT `recipe_steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_videos`
--
ALTER TABLE `recipe_videos`
  ADD CONSTRAINT `recipe_videos_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
