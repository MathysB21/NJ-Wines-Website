-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2024 at 12:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nj_wines`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `email`, `password`, `address`, `city`, `postal_code`, `country`, `phone`) VALUES
(2, 'Mathys', 'Basson', 'pieterm.basson@gmail.com', 'M@t7ty^', '', 'Cape Town', '8000', 'South Africa', NULL),
(3, 'Pieter', NULL, 'mathysbasson007@gmail.com', 'MattyBuhhh88', NULL, NULL, NULL, NULL, NULL),
(4, 'Peter', NULL, 'peter.bassy@gmail.com', 'Bassy675@!', NULL, NULL, NULL, NULL, NULL),
(5, 'Jannnie', NULL, 'jannie@gmail.com', 'Jannie007^', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `status`, `total_amount`, `payment_method`) VALUES
(1, 5, NULL, 'pending', 6375.30, 'unknown'),
(2, 2, NULL, 'pending', 40082.70, 'unknown');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `wine_id` varchar(60) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `wine_id`, `quantity`, `price`) VALUES
(9, 1, 'estate-cabernet-sauvignon', 18, 115.20),
(10, 1, 'reserve-chardonnay', 24, 142.10);

-- --------------------------------------------------------

--
-- Table structure for table `wines`
--

CREATE TABLE `wines` (
  `id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `year` int(4) NOT NULL,
  `flavours` varchar(128) NOT NULL,
  `details` varchar(660) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `amount` int(5) NOT NULL,
  `image_link` varchar(75) NOT NULL,
  `wine_range` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wines`
--

INSERT INTO `wines` (`id`, `name`, `year`, `flavours`, `details`, `price`, `amount`, `image_link`, `wine_range`) VALUES
('christine-marie-cap-classique', 'Christine Marié Cap Classique', 2021, 'honey, stone fruit, pineapple', 'Has honey nuances from spending 43 months on its lees before degorgement. Made from 100% Chardonnay, there’s stone fruit throughout, mainly white peach, with a hint of tropical fruit adding interest. Zinging fresh, it ends crisply dry but still packed with fruit. Serve as an aperitif with charcuterie, or as a celebration drink because it’s so flavoursome. One can easily enjoy more than a glass.', 88.90, 4100, '../images/2-Niel-Joubert-Christine-Marie-Cap-Classique.png', 'Christine Marié Range'),
('christine-marie-first-kiss', 'Christine Marié First Kiss', 2012, 'melon, ginger, sultana', 'A fortified Chenin Blanc which has spent two years in older French barrels. Not produced every year, available in limited quantities and sold in a 500ml bottle. A lovely orange gold colour. The perfume is melon and ginger preserve, with a nuance of sultanas. Oaking comes through as butterscotch and peanut brittle. The flavours are a wonderful combination of sweet and savoury, a richness that isn’t cloying. More medium-sweet than full sweet.', 150.70, 3500, '../images/1-Niel-Joubert-Christine-MariFirst-Kiss.png', 'Christine Marié Range'),
('estate-cabernet-sauvignon', 'Estate Cabernet Sauvignon', 2019, 'dark berry, plums, vanilla', 'This wine leads with dark berry and plum aromas on the nose. There is a gentle herbaceous top note, even with a hint of vanilla. The succulent palate is smooth, carrying the berry fruit to a satisfyingly luscious conclusion. 30% Matured in Old French Oak barrels for 18 months.', 115.20, 4500, '../images/7-Niel-Joubert-Estate-Cabernet-Sauvignon-NV.png', 'Estate Range'),
('estate-chardonnay', 'Estate Chardonnay', 2021, 'citrus, biscotti, nuts', 'This wine is citrus-forward with undertones of biscotti and nuts. On the palate, the acidity is surprisingly racy, but a subtle sweetness prevents it from being overpowering. The flavors are primarily fruity with hints of sweet oak flavors. A layered wine with a crisp finish. 15% Matured in New French Oak barrels for 6 months.', 78.80, 8400, '../images/3-Niel-Joubert-Estate-Chardonnay-NV.png', 'Estate Range'),
('estate-chenin-blanc', 'Estate Chenin Blanc', 2022, 'passionfruit, grapefruit, green apple', 'The wine\'s bouquet opens with a burst of passion fruit followed by ripe grapefruit. Notes of minerality add elegance. It is delicate yet fresh which is expressed through its well-balanced acidity and enveloping fruity flavors of citrus, passion fruit and crisp green apple. The wine has a long fruity finish.', 85.50, 6300, '../images/1-Niel-Joubert-Estate-Chenin-Blanc-NV.png', 'Estate Range'),
('estate-merlot', 'Estate Merlot', 2021, 'tomato stew, ripe plums, raspberry', 'This wine has a rich purple-red color, and its nose is filled with enticing aromas of tomato stew, ripe plums, raspberries, all-spice, and a hint of dark chocolate. The entry on the palate is smooth, with a silky tannin structure and a plush red fruit core. The balanced acidity acts as the perfect foil for the fruit spectrum and carries the wine all the way to the finish, ending with lingering flavors of crunchy red currants and ripe plums.', 82.60, 6600, '../images/6-Niel-Joubert-Estate-Merlot-NV.png', 'Estate Range'),
('estate-pinotage', 'Estate Pinotage', 2018, 'dark berry, prunes, vanilla', 'The wine has a rich and concentrated bouquet of dark berry confit, prunes, vanilla, and sweet spice notes. It\'s a lighter style wine with soft acidity, smooth tannins, and a fruit-forward palate with just a hint of toffee, which is perfect for the wine lover who dislikes more robust styles of Pinotage. This wine is completely unwooded.', 95.75, 5000, '../images/4-Niel-Joubert-Estate-Pinotage-NV.png', 'Estate Range'),
('estate-sauvignon-blanc', 'Estate Sauvignon Blanc', 2022, 'white peach, passionfruit, orange blossom', 'Bursting with exotic aromas of white peach, passion fruit, yellow citrus, orange blossoms and green pepper. The palate shows lovely fruit concentration, with a delicate texture and a lifting acidity. Pure, focused, elegant and fresh, with lingering notes of guava and citrus fruits on the lengthy, dry finish.', 124.25, 3500, '../images/2-Niel-Joubert-Estate-Sauvignon-Blanc-NV.png', 'Estate Range'),
('estate-shiraz', 'Estate Shiraz', 2019, 'leather, tobacco, prunes', 'Classical varietal aromas of leather, tobacco roll, prunes, cloves, black pepper and game meat, all rounded off by a subtle hint of dark chocolate. The palate is medium-bodied, with well-integrated tannins and complementary oak nuances. The flavors follow through nicely from the nose, with notes of spice, purple fruits, and raspberries. The wine has a juicy fruit core with a satisfying, dry finish.', 101.40, 2200, '../images/5-Niel-Joubert-Estate-Shiraz-NV.png', 'Estate Range'),
('lifestyle-blanc-de-noir', 'Lifestyle Blanc De Noir', 2022, 'strawberry, candy floss, rose water', 'With a pale rose gold color, the wine\'s bouquet opens with enticing notes of strawberry, candy floss and rose water. On the palate it is elegant with delectably fresh red berry flavors. It finished with a lingering freshness.', 72.30, 8200, '../images/1-Niel-Joubert-Blanc-de-Noir-NV.png', 'Lifestyle Range'),
('lifestyle-cinsault-grenache-noir', 'Lifestyle Cinsault - Grenache Noir', 2020, 'raspberry, red cherry, red plums', 'Aromatic scents of raspberry, red cherry, red plums and boiled sweets dominate the nose, while an underlying tone of mixed herbs and white pepper add further interest. The palate is light and fresh, with silky tannins and a vibrant acidity. Plush flavours of crunchy red currants are underpinned by a lovely savoury edge. A dry, elegant wine with lingering notes of ripe cherries on the finish. Serve slightly chilled to enhance the red berry fruit spectrum.', 112.80, 5800, '../images/3-Niel-Joubert-Cinsault-Grenache-Noir-NV.png', 'Lifestyle Range'),
('lifestyle-gruner-veltliner', 'Lifestyle Grüner Veltliner', 2022, 'peaches & cream, ripe fruits, vanilla beans', 'This pale wine shows surprising depth in aroma which is reminiscent of peaches and cream and underscored by a medley of ripe fruits and subtle hints of vanilla beans. This medium-bodied wine has soft acidity and a hint of sweetness that compliments a fruity palate. It finishes with a bright acidity that leaves an impression of a refreshingly crisp wine.', 90.10, 2400, '../images/2-Niel-Joubert-Gruner-Veltliner-NV.png', 'Lifestyle Range'),
('reserve-cabernet-sauvignon', 'Reserve Cabernet Sauvignon', 2016, 'dark fruit, coffee, dark chocolate', 'The bouquet leads with rich dark fruits, followed by savory and roasted coffee. It has velvety tannins and its excellent balance between tannins, acidity, and fruitiness shows finesse. This full-bodied wine finishes with lingering dark chocolate and savory flavors. 100% Matured in New French Oak 225-liter barrels for 72 months.', 121.80, 4100, '../images/6-Niel-Joubert-Reserve-Cabernet-Sauvignon-NV.png', 'Reserve Range'),
('reserve-chardonnay', 'Reserve Chardonnay', 2019, 'spiced citrus, caramel, warm spices', 'This delightful butter-yellow wine serves heaps of spiced citrus rind on the nose. The lively fruit carries through to the palate where it is supported by hints of caramel, oak and warm spices. Full-bodied and rich with a bright acidity, the wine lingers beautifully. 80% Matured in New French Oak 400-liter barrels for 26 months.', 142.10, 2800, '../images/3-Niel-Joubert-Reserve-Chardonnay-NV.png', 'Reserve Range'),
('reserve-chenin-blanc', 'Reserve Chenin Blanc', 2019, 'apple, quince, pineapple', 'Expressive aromas of yellow apple, quince, kumquat, dried pineapple, and a touch of oak spice. The palate has an excellent balance of fruit and oak, with bright acidity adding freshness and backbone. The wine has a creamy, rounded mouthfeel and a satisfying finish with yellow citrus and stone fruit flavours. A complex, food-friendly wine that will facilitate further bottle ageing for 5-6 years from vintage.', 126.60, 5600, '../images/2-Niel-Joubert-Reserve-Chenin-Blanc-NV.png', 'Reserve Range'),
('reserve-grenache-blanc', 'Reserve Grenache Blanc', 2019, 'oak, lemon, apricot', 'Deep gold and inviting, this wine has prominent oak notes that specifically presents cloves, along with subtle lemon and apricot on the nose. On the palate it is bright and fruity with pineapple and lemon cream flavors. Its acidity is quite zesty and balanced with a hint of sweetness. The finish is predominantly oaky with soft caramel notes. 60% Matured in New French oak barrels for 26 months.', 103.20, 7300, '../images/1-Niel-Joubert-Reserve-Grenache-Blanc-NV.png', 'Reserve Range'),
('reserve-proprietor-malbec', 'Reserve Proprietor Malbec', 2022, 'dark berry, coffee, caramel', 'The Niel Joubert Proprietor Malbec is a distinguished wine that captivates with its intense flavors and exquisite aromas. Crafted from carefully selected Malbec grapes, this wine showcases the perfect harmony between dark berry notes, aromatic coffee undertones, and a hint of caramel sweetness. With each sip, the robust flavors unfold on the palate, creating a rich and indulgent experience.', 330.00, 7600, '../images/7-Niel-Joubert-Proprietor-Malbec-NV.png', 'Reserve Range'),
('reserve-shiraz', 'Reserve Shiraz', 2015, 'coffee, oak, sweet spice', 'Deep garnet in color with a prominent bouquet of coffee, oak and sweet spice. The wine is flavorful and complex with layers of blackberry, oak and spice cascading on the palate. Full-bodied, polished and expertly balanced with velvety tannins and great length. 75% Matured in New French and Hungarian Oak barrels. 25% Matured in older French Oak barrels for 60 months.', 78.40, 7500, '../images/4-Niel-Joubert-Reserve-Shiraz-NV.png', 'Reserve Range'),
('reserve-tempranillo', 'Reserve Tempranillo', 2020, 'herbal, caramel, dark fruit', 'This deep burgundy colored wine shows subtle herbal aromas supported by rich caramel notes and concentrated dark fruit. Fleshy and well-rounded, it shows intense dark fruit, mocha, and caramel flavors on the palate. Subtle sweetness, balanced acidity, and structured tannins make for a wine with finesse. 60% Matured in New French Oak Barrels for 16 months.', 94.70, 4300, '../images/5-Niel-Joubert-Reserve-Tempranillo-NV.png', 'Reserve Range');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `wine_id` (`wine_id`);

--
-- Indexes for table `wines`
--
ALTER TABLE `wines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`wine_id`) REFERENCES `wines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
