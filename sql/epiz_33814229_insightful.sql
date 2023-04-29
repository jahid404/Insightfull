-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql300.epizy.com
-- Generation Time: Mar 24, 2023 at 11:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1001, 'admin@insightful.com', '8bffe52086489faab9f05174d2e71d54');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `quantity`, `email`, `order_date`) VALUES
(920596, 5600, 69460, 6, 'jsjahid215@gmail.com', '2023-03-24 11:18:05'),
(920596, 5600, 87622, 3, 'jsjahid215@gmail.com', '2023-03-24 11:18:05'),
(920596, 5600, 13961, 6, 'jsjahid215@gmail.com', '2023-03-24 11:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_price`, `product_description`, `product_category`, `product_image`) VALUES
(62764, 'Retro Wave T-Shirt', '258.00', 'This t-shirt features a bold, graphic design inspired by the colorful patterns of the 80s. Made from 100% cotton, it\'s soft and comfortable for everyday wear.', 'T-Shirts', 'https://images.unsplash.com/photo-1523663995-8ba5c359fa83?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(21543, 'Tie-Dye Crop Top', '368.00', 'This cute crop top is perfect for summer festivals or beach days. The tie-dye pattern adds a fun and playful touch to any outfit.', 'T-Shirts', 'https://images.unsplash.com/photo-1598627799202-457cf4b09d1c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(67892, 'Organic V-Neck', '436.00', 'For those who value sustainability, this t-shirt is made from 100% organic cotton. The V-neck adds a touch of sophistication to a classic staple.', 'T-Shirts', 'https://images.unsplash.com/photo-1571455786673-9d9d6c194f90?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(48685, 'High-Waist Jeans', '345.00', 'These jeans are the perfect addition to any retro-inspired wardrobe. The high waist and slim fit create a flattering silhouette.', 'Jeans', 'https://images.unsplash.com/photo-1592595293637-8557fa6d3c64?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(61227, 'Distressed Jeans', '328.00', 'This relaxed fit jean has a distressed finish, giving it a worn-in, vintage look. Perfect for casual days out with friends.', 'Jeans', 'https://images.unsplash.com/photo-1547227795-33be3f89c971?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(87331, 'Skinny Ankle Jeans', '235.00', 'These jeans hug your curves in all the right places and feature a trendy ankle length. Dress them up or down depending on the occasion.', 'Jeans', 'https://images.unsplash.com/photo-1608613517869-07b097abbcf3?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(24889, 'Striped Button-Up', '754.00', 'This classic button-up shirt features a timeless striped pattern that can be dressed up or down. The soft, breathable fabric makes it comfortable to wear all day.', 'Jackets', 'https://images.unsplash.com/photo-1620403724318-2d40745e0f1b?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(70403, 'Short-Leg Pants', '543.00', 'These breezy pants are perfect for summer. The wide-leg silhouette and linen fabric create a flowy, relaxed look.', 'Shorts', 'https://images.unsplash.com/photo-1591717243318-4f4316e5e0ac?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(15266, 'Oxford Shirt', '720.00', 'This preppy shirt features a button-down collar and a textured fabric that adds a touch of sophistication to any outfit. The relaxed fit makes it comfortable to wear all day.', 'Shirts', 'https://images.unsplash.com/photo-1650632784710-dbae1da131cb?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(57736, 'Cargo Joggers', '450.00', 'These stylish joggers are the perfect combination of comfort and utility. The cargo pockets and drawstring waist make them versatile and practical for everyday wear.', 'Pants', 'https://images.unsplash.com/photo-1616945766835-f43cf889e4ce?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(14124, 'Wrap Midi Dress', '360.00', 'This elegant midi dress features a flattering wrap silhouette and a beautiful floral print. Perfect for special occasions or a day out with friends.', 'Dresses', 'https://images.unsplash.com/photo-1640654486694-4c53826bbb53?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(26089, 'Button-Up Shirt', '690.00', 'This classic shirt features a button-up front and a collared neckline. Perfect for dressing up or down, this versatile shirt can be worn with dress pants or jeans.', 'Shirts', 'https://images.unsplash.com/photo-1647588190158-75ae11176b6e?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(44587, 'Shift Dress', '630.00', 'This classic shift dress is a versatile wardrobe staple. The simple silhouette can be dressed up or down depending on the occasion.', 'Dresses', 'https://images.unsplash.com/photo-1631978278971-9afda1670882?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(91991, 'Leather Moto Jacket', '1230.00', 'This edgy moto jacket adds a touch of rock-and-roll to any outfit. The faux leather material is cruelty-free and environmentally friendly.', 'Jackets', 'https://images.unsplash.com/photo-1579967323563-49e0e7f33f98?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(57918, 'Flannel Shirt', '850.00', 'This cozy shirt features a soft flannel fabric that\'s perfect for cooler weather. The plaid pattern and button-up front create a casual, rustic look.', 'Shirts', 'https://images.unsplash.com/photo-1624222244232-5f1ae13bbd53?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(56425, 'Oversized Blazer', '1480.00', 'This oversized blazer creates a polished, sophisticated look. Perfect for the office or a night out on the town.', 'Jackets', 'https://images.unsplash.com/photo-1675845929869-011079187b16?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(22635, 'Pleated Midi Skirt', '450.00', 'This elegant skirt features pleats that create a beautiful flowy silhouette. The midi length is perfect for showing off your favorite shoes.', 'Skirts', 'https://images.unsplash.com/photo-1594633313515-7ad9334a2349?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(19320, 'Denim Skirt', '640.00', 'This classic denim skirt features a trendy button-front and a flattering A-line silhouette. The versatile style can be dressed up or down.', 'Skirts', 'https://images.unsplash.com/photo-1517751211783-9b7c8dd2d406?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(45845, 'Floral Mini Skirt', '550.00', 'This playful mini skirt features a colorful floral print that adds a touch of whimsy to your wardrobe. The lightweight fabric makes it perfect for summer.', 'Skirts', 'https://images.unsplash.com/photo-1574413230119-f302e1c9035d?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(43080, 'Cable Knit Sweater', '360.00', 'This cozy sweater features a classic cable knit design that never goes out of style. Perfect for staying warm on chilly days.', 'Sweaters', 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(56505, 'Turtleneck Sweater', '280.00', 'This stylish sweater features a chic turtleneck and a fitted silhouette that flatters any body type. Dress it up or down depending on the occasion.', 'Sweaters', 'https://images.unsplash.com/photo-1603570112520-fdc514048979?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(17054, 'Oversized Sweater', '320.00', 'This oversized sweater is perfect for creating a relaxed, casual look. The loose fit and soft material make it comfortable to wear all day.', 'Sweaters', 'https://images.unsplash.com/photo-1509679708047-e0e562d21e44?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(46302, 'Chunky Cardigan', '420.00', 'This chunky knit cardigan is perfect for layering over your favorite tops. The oversized fit and cozy material make it perfect for cooler weather.', 'Sweaters', 'https://images.unsplash.com/photo-1614015189527-9266c635a165?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(78517, 'Cashmere Sweater', '1290.00', 'This luxurious sweater is made from soft, high-quality cashmere that feels amazing against your skin. Perfect for adding a touch of elegance to any outfit.', 'Sweaters', 'https://images.unsplash.com/photo-1619708443838-df616a72bb74?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(66670, 'Striped Sweater', '690.00', 'This playful sweater features colorful stripes that add a touch of fun to your wardrobe. The relaxed fit and soft material make it perfect for everyday wear.', 'Sweaters', 'https://images.unsplash.com/photo-1505632958218-4f23394784a6?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(77855, 'Ribbed Sweater', '750.00', 'This trendy sweater features a ribbed texture that creates a slimming effect. The fitted silhouette makes it perfect for pairing with high-waisted pants or skirts.', 'Sweaters', 'https://images.unsplash.com/photo-1514436864212-7c1f9f1cb21b?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(43049, 'Classic Suit', '860.00', 'This timeless suit features a classic cut and a neutral color that can be dressed up or down. Perfect for job interviews, weddings, or other formal events.', 'Suits', 'https://images.unsplash.com/photo-1548917459-67156eade1f1?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(87622, 'Slim Fit Suit', '1150.00', 'This modern suit features a slim fit that creates a sleek, streamlined silhouette. The lightweight fabric makes it comfortable to wear all day.', 'Suits', 'https://images.unsplash.com/photo-1591961161110-fa4752bf1030?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(13961, 'Tuxedo', '1850.00', 'This formal suit features a black jacket with satin lapels and matching pants. Perfect for black-tie events or weddings.', 'Suits', 'https://images.unsplash.com/photo-1669207261271-a0041d4b0948?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(69460, 'Plaid Suit', '1350.00', 'This trendy suit features a bold plaid pattern that adds a touch of personality to your wardrobe. The slim fit and modern cut create a contemporary look.', 'Suits', 'https://images.unsplash.com/photo-1537511446984-935f663eb1f4?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(33503, 'Chambray Shirt', '550.00', 'This lightweight shirt features a breathable chambray fabric that\'s perfect for warmer weather. The classic collar and button-up front create a polished look that\'s perfect for any occasion.', 'Shirts', 'https://images.unsplash.com/photo-1596357774502-c1d3a5b35521?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(24417, 'A-Line Skirt', '350.00', 'This classic skirt features a flattering A-line silhouette that flares out from the waist. Perfect for pairing with a blouse or sweater for a polished, feminine look.', 'Skirts', 'https://images.unsplash.com/photo-1585660738330-fd40f7586049?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(34277, 'Pleated Skirt', '260.00', 'This elegant skirt features delicate pleats that add texture and movement to your outfit. Perfect for dressing up for special occasions.', 'Skirts', 'https://images.unsplash.com/photo-1534445538923-ab38438550d2?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(86200, 'Pencil Skirt', '360.00', 'This sleek skirt features a form-fitting silhouette that hugs your curves. Perfect for creating a professional, sophisticated look at the office or for a night out.', 'Skirts', 'https://images.unsplash.com/photo-1554838376-645964ce075c?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500'),
(64106, 'Maxi Skirt', '460.00', 'This flowy skirt features a long length that creates a bohemian, free-spirited vibe. Perfect for pairing with a crop top or blouse for a relaxed, beachy look.', 'Skirts', 'https://images.unsplash.com/photo-1656252528492-e44738396fcb?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=500&w=500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(11) NOT NULL,
  `card` bigint(16) NOT NULL,
  `exp` varchar(5) NOT NULL,
  `cvv` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `address`, `city`, `state`, `zip`, `card`, `exp`, `cvv`) VALUES
(5600, 'John Doe', 'jsjahid215@gmail.com', '179ad45c6ce2cb97cf1029e212046e81', 'address ', 'city', 'state', 3800, 36, '3', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
