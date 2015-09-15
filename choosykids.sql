-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 08:31 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `choosykids`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `AdminRole` varchar(255) NOT NULL,
  `LastLogin` date NOT NULL,
  `Status` enum('1','0','-1') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `UserName`, `Password`, `FirstName`, `LastName`, `Email`, `AdminRole`, `LastLogin`, `Status`) VALUES
(1, 'admin', 'V1ZkU2RHRlhOSGhOYWswOQ==', 'admin', '', 'admin@yahoo.com', 'Super Admin', '2013-11-15', '1'),
(16, 'bharat', 'V1ZkU2RHRlhORDA9', 'patel ', 'bharat', 'bhushan@karmasource.net', 'Admin', '0000-00-00', '-1'),
(17, 'vvv', 'VFZSSmVrNUVWVDA9', 'patel', 'vvv', 'ravi@karmasource.net', 'Admin', '0000-00-00', '-1'),
(18, '514566', 'V1ZkU2RHRlhORDA9', 'patel', 'bharat', 's.bhushan011@gmail.com', 'Admin', '0000-00-00', '-1'),
(19, 'sdsasa', 'WXpKU2FHTXlVVDA9', 'patel', 'vvv', 'bhushan@karmasource.net', 'Admin', '0000-00-00', '-1'),
(20, 'blackpearl', 'V1ZkU2RHRlhOV2hhUnpGd1ltYzlQUT09', 'patel', 'blackpearl', 'bhushan@karmasource.net', '', '0000-00-00', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `mn_user`
--

CREATE TABLE IF NOT EXISTS `mn_user` (
  `mn_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `mn_user_type` enum('S','P','A') NOT NULL,
  `mn_user_display_name` varchar(255) NOT NULL,
  `mn_user_password` varchar(255) NOT NULL,
  `mn_user_email` varchar(255) NOT NULL,
  `mn_user_gender` enum('M','F') NOT NULL,
  `mn_user_phone` bigint(11) NOT NULL,
  `mn_user_address` varchar(255) NOT NULL,
  `mn_user_city` varchar(255) NOT NULL,
  `mn_user_province` varchar(255) NOT NULL,
  `mn_user_country` varchar(255) NOT NULL,
  `mn_user_school` varchar(255) NOT NULL,
  `mn_user_program` varchar(255) NOT NULL,
  `mn_paypal_email` varchar(255) NOT NULL,
  `mn_user_activationcode` varchar(255) NOT NULL,
  `mn_user_last_login` datetime NOT NULL,
  `mn_user_created_date` datetime NOT NULL,
  `mn_user_modified_date` datetime NOT NULL,
  `status` enum('1','0','-1') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`mn_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `mn_user`
--

INSERT INTO `mn_user` (`mn_user_id`, `mn_user_type`, `mn_user_display_name`, `mn_user_password`, `mn_user_email`, `mn_user_gender`, `mn_user_phone`, `mn_user_address`, `mn_user_city`, `mn_user_province`, `mn_user_country`, `mn_user_school`, `mn_user_program`, `mn_paypal_email`, `mn_user_activationcode`, `mn_user_last_login`, `mn_user_created_date`, `mn_user_modified_date`, `status`) VALUES
(25, 'P', 'Test User', '0192023a7bbd73250516f069df18b500', 'ravi@karmasource.net', 'M', 8306710586, 'Demo address ', 'Passaic', 'Nj', 'USA', 'Saint Thomas ', 'MCA', 'ravi@karmasource.net', 'cs7le', '2013-07-15 10:25:52', '2013-06-17 09:11:59', '0000-00-00 00:00:00', '1'),
(26, 'S', 'Bhushan Sonar', '0192023a7bbd73250516f069df18b500', 'bhushan@karmasource.net', 'M', 8306710585, 'test ', 'Test', 'Test', 'Test', 'Test', 'Test', '', 'ces5m', '2013-07-22 08:38:12', '2013-06-19 12:50:50', '0000-00-00 00:00:00', '-1'),
(27, 'S', 'Fdsf Asfsa', 'fcea920f7412b5da7be0cf42b8c93759', 'manish@yahoo.com', 'M', 5245478454, 'dsfsdafasdfsadf ', 'A', 'A', 'A', 'A', 'A', '', '3kdvg', '0000-00-00 00:00:00', '2013-07-03 12:21:59', '0000-00-00 00:00:00', '-1'),
(28, 'P', 'Ravi Sharma', '0192023a7bbd73250516f069df18b500', 's.bhushan011@gmail.com', 'M', 8866478626, 'my address', 'Passaic', 'A', 'USA', 'Saint Thomas ', 'MCA', 's.bhushan011@gmail.com', '8fskl', '2013-07-15 10:17:35', '2013-07-12 09:56:30', '0000-00-00 00:00:00', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `OrderId` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionId` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `OrderTime` varchar(255) NOT NULL,
  `Confirm` varchar(255) NOT NULL,
  `Totalamount` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL,
  PRIMARY KEY (`OrderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`OrderId`, `TransactionId`, `UserId`, `OrderTime`, `Confirm`, `Totalamount`, `Status`) VALUES
(18, '98317219642908747', 49, '2013-11-07T10:58:48Z', 'Pending', 1122, 'Pending'),
(19, '98317219642908747', 49, '2013-11-07T10:58:48Z', 'Pending', 1122, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `PaymentId` int(11) NOT NULL AUTO_INCREMENT,
  `TransactionId` varchar(255) NOT NULL,
  `TransactionType` varchar(255) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `CurrencyCode` varchar(255) NOT NULL,
  `PaymentStatus` varchar(255) NOT NULL,
  `OrderTime` varchar(255) NOT NULL,
  `ACK` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `ProductSize` int(11) NOT NULL,
  `Product_Qty` int(11) NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `ShipToAddress` varchar(255) NOT NULL,
  `ShipToCity` varchar(255) NOT NULL,
  `ShipToState` varchar(255) NOT NULL,
  `ShipToCountry` varchar(255) NOT NULL,
  `ShipToZip` int(11) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  PRIMARY KEY (`PaymentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentId`, `TransactionId`, `TransactionType`, `PaymentType`, `CurrencyCode`, `PaymentStatus`, `OrderTime`, `ACK`, `Email`, `UserId`, `FirstName`, `LastName`, `ProductId`, `ProductSize`, `Product_Qty`, `ProductPrice`, `ShipToAddress`, `ShipToCity`, `ShipToState`, `ShipToCountry`, `ShipToZip`, `TotalAmount`) VALUES
(144, '', '', '', '', '', '', 'Failure', 'demo@gmail.com', 49, 'demo', 'demo1', 133, 0, 1, 250, 'dsjhgdas', 'ahmedabad', 'asdjhdsj', 'kjnjdskd', 352516, 0),
(145, '', '', '', '', '', '', 'Failure', 'demo@gmail.com', 49, 'demo', 'demo1', 133, 0, 1, 250, 'dsjhgdas', 'ahmedabad', 'asdjhdsj', 'kjnjdskd', 352516, 0),
(146, '', '', '', '', '', '', 'Failure', 'demo@gmail.com', 49, 'demo', 'demo1', 133, 0, 1, 250, 'dsjhgdas', 'ahmedabad', 'asdjhdsj', 'kjnjdskd', 352516, 0),
(147, '8D951905MK041054U', 'expresscheckout', 'instant', 'USD', 'Pending', '2013-11-16T11:25:15Z', 'Success', 'demo@gmail.com', 49, 'demo', 'demo1', 133, 0, 1, 250, 'dsjhgdas', 'ahmedabad', 'asdjhdsj', 'kjnjdskd', 352516, 12750);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `ProductId` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(255) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `ProductImage` text NOT NULL,
  `audio` varchar(255) NOT NULL,
  `priview_audio` varchar(255) NOT NULL,
  `product_type` enum('1','2') NOT NULL,
  `ProductPrice` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('-1','0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`ProductId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `ProductName`, `CategoryId`, `ProductImage`, `audio`, `priview_audio`, `product_type`, `ProductPrice`, `description`, `status`) VALUES
(126, 'Choosy Black IMIL T-shirt', 61, 'product_126.jpg', '', '', '1', 300, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(132, 'Choosy Blue T-Shirt', 63, 'product_132.jpg', '', '', '1', 200, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(133, 'C.H.O.O.S.Y. Name Shirt', 64, 'product_133.jpg', '', '', '1', 250, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(134, 'C.H.O.O.S.Y. Daisy T-shirt', 64, 'product_134.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(135, 'Choosy Black IMIL T-shirt', 65, 'product_126.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(136, 'Choosy Blue T-Shirt', 61, 'product_132.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(137, 'C.H.O.O.S.Y. Name Shirt45', 63, 'c9ff9_lime t small.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(138, 'C.H.O.O.S.Y. Daisy T-shirt', 64, 'product_134.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(139, 'Choosy Black IMIL T-shirt', 66, 'product_126.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(140, 'Choosy Blue T-Shirt', 66, 'product_132.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(141, 'C.H.O.O.S.Y. Name Shirt', 67, 'product_133.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1'),
(142, 'C.H.O.O.S.Y. Daisy T-shirt', 67, 'product_134.jpg', '', '', '1', 400, 'Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_qty`
--

CREATE TABLE IF NOT EXISTS `product_qty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(10) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `SubCategoryId` int(11) NOT NULL,
  `status` enum('-1','0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE IF NOT EXISTS `product_review` (
  `review_Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProductId` int(11) NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `review_title` varchar(255) NOT NULL,
  `review_description` text NOT NULL,
  `add_date` date NOT NULL,
  `status` enum('-1','0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`review_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`review_Id`, `ProductId`, `review_name`, `review_title`, `review_description`, `add_date`, `status`) VALUES
(2, 132, 'kevin james', 'choosy t-shirt', '1. hasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.', '2013-10-19', '1'),
(3, 132, 'kevin james', 'choosy t-shirt', '1. hasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.', '2013-10-19', '1'),
(4, 132, 'kevin james', 'choosy t-shirt', '1. hasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.', '2013-10-19', '1'),
(5, 132, 'kevin james', 'choosy t-shirt', '1. hasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.', '2013-10-19', '1'),
(21, 126, 'kevin james', 'choosy t-shirt', '1. hasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec, luctus a, lorem. Maecenas tristique orci ac sem. Duis ultricies pharetra magna. Donec accumsan malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna.', '2013-10-21', '1'),
(22, 134, 'ravi', 'test', 'this is test review', '2013-10-21', '1'),
(23, 126, 'bharat', 'good', 'very nice', '2013-10-23', '-1'),
(24, 126, 'bharat', 'good', 'xxxxxxx', '2013-10-23', '-1'),
(25, 126, 'bharat', 'good', 'xxxxxxxx', '2013-10-23', '-1'),
(26, 126, 'gg', 'ggg', 'ggg', '2013-10-28', '-1'),
(27, 126, 'gg', 'ggg', 'ggg', '2013-10-28', '-1'),
(28, 126, 'ff', 'fff', 'fff', '2013-11-14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `CartId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` varchar(255) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` int(11) NOT NULL,
  PRIMARY KEY (`CartId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`CartId`, `UserId`, `ProductId`, `Quantity`, `Size`) VALUES
(20, 'qi729ibd530h3e8qfleaf59d71', 137, 11817, 0),
(21, 'qi729ibd530h3e8qfleaf59d71', 138, 1, 0),
(23, 'epp6smaac0qeggie3rejf9quh5', 140, 1, 0),
(24, 'sogl5n1rpaepjvr2e2rdabksc4', 141, 1, 0),
(25, '5gn0qplvsu6p87hdoi8murt3r4', 142, 11817, 0),
(26, 'epp6smaac0qeggie3rejf9quh5', 165, 11817, 0),
(27, '5gn0qplvsu6p87hdoi8murt3r4', 167, 1, 0),
(28, 'qbp66udvccsprolkemhbdvgvo1', 171, 11817, 0),
(84, '49', 133, 1, 0),
(85, 'pi8o1nd3itqfmg2bmg2qo68p50', 136, 2, 0),
(86, 'pi8o1nd3itqfmg2bmg2qo68p50', 126, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_content`
--

CREATE TABLE IF NOT EXISTS `site_content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` varchar(512) NOT NULL DEFAULT '',
  `content_type` enum('Page','Post') NOT NULL,
  `content_excerpt` text NOT NULL,
  `seo_introductory_text` text,
  `seo_text` text NOT NULL,
  `content` text NOT NULL,
  `content_order` int(11) NOT NULL DEFAULT '0',
  `content_uri` varchar(512) NOT NULL DEFAULT '',
  `status` enum('0','1','-1') NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `site_content`
--

INSERT INTO `site_content` (`content_id`, `content_title`, `content_type`, `content_excerpt`, `seo_introductory_text`, `seo_text`, `content`, `content_order`, `content_uri`, `status`) VALUES
(35, 'home', 'Page', '', '', '', '<h3>Home</h3>\r\n\r\n<p><img alt="" src="http://localhost/choosy_kids/uploads/images/aboutus.png" style="float:right; height:378px; width:320px" /></p>\r\n\r\n<p>Choosy Kids, LLC is a company devoted to promoting healthy habits in young children and their families. It was founded on the belief that healthy preferences for food choices, physical activity, and daily health routines can be developed early in life. Choosy Kids honors the role that parents, early educators, and health care providers play in helping children develop healthy lifestyles. Choosy Kids is nationally recognized for developing and delivering exemplary staff training, lively music, and easily understood resource materials for promoting healthy habits.</p>\r\n\r\n<p>To read statements about our company&rsquo;s mission, vision, and values, click here.</p>\r\n', 0, 'home', '1'),
(37, 'aboutus', 'Page', '                            ', '                            ', '                            ', '<h3>ABOUT US</h3>\r\n<p><img alt="" src="http://localhost/choosy_kids//uploads/images/aboutus.png" style="float:left; height:378px; width:320px" /><strong>Choosy Kids, LLC is a company devoted to promoting healthy habits in</strong><strong> young children and their families. It was founded on the belief that healthy preferences for food choices, physical activity, and daily health routines can be developed early in life. Choosy Kids honors the role that parents, early educators, and health care providers play in helping children develop healthy lifestyles. Choosy Kids is nationally recognized for developing and delivering exemplary staff training, lively music, and easily understood resource materials for promoting healthy habits. </strong></p>\r\n\r\n<p><strong>To read statements about our company&rsquo;s mission, vision, and values, click here.</strong></p>\r\n', 0, 'aboutus', '1'),
(38, 'the_health_hero_choosy', 'Page', '', '', '', '<div class="col-holder">\r\n<h3>The Health Hero Choosy</h3>\r\n\r\n<p>Choosy&rsquo;s bright colors and unique appearance instantly sparks interest and intrigue. Children are quick to ask, &ldquo;What is Choosy?&rdquo; &ldquo;Where is he from?&rdquo; &ldquo;Is Choosy a boy or a girl?&rdquo;</p>\r\n\r\n<p>Choosy can be whatever children imagine&hellip;..a bug, an alien, a boy or girl. Choosy is a friend who encourages us to make healthier choices for small, everyday decisions. His health messages and unique image remind us to make the &ldquo;Choosy Choice,&rdquo; which is always the healthier option. Choosy&rsquo;s motto is &ldquo;Be Choosy, Be Healthy.&rdquo; Click the boxes below to learn more about Choosy.</p>\r\n<strong>Meet Choosy</strong>\r\n<p><iframe height="345" src="http://www.youtube.com/embed/XGSy3_Czz8k" width="420"></iframe></p>\r\n</div>\r\n', 0, 'the_health_hero_choosy', '1'),
(42, 'music', 'Page', '', '', '', '', 0, 'music', '1'),
(43, 'allproducts', 'Page', '', '', '', '<div style="width:100%;overflow:hidden">\r\n<div style="width:25%;float:left">\r\n<ul>\r\n	<li><a href="#">Accessories</a></li>\r\n	<li><a href="#">All Products</a></li>\r\n	<li><a href="#">Classroom Resources</a></li>\r\n	<li><a href="#">Music &amp; Video</a></li>\r\n	<li><a href="#">Product Catalog</a></li>\r\n	<li><a href="#">Special</a></li>\r\n	<li><a href="#">T-Shirst</a></li>\r\n</ul>\r\n</div>\r\n\r\n<div style="width:74%;float:right">\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/black%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Choosy Black IMIL T-shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2-resources/images/website/products/bluesm.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Choosy Blue T-Shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/lime%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">C.H.O.O.S.Y. Name Shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/daisy%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Daisy T-shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/black%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Choosy Black IMIL T-shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2-resources/images/website/products/bluesm.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Choosy Blue T-Shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/lime%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">C.H.O.O.S.Y. Name Shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;\r\n\r\n<p><img alt="black t small.jpg" src="http://www.choosykids.com/CK2/products/daisy%20t%20small.jpg" style="float:left; height:139px; width:160px" /></p>\r\n\r\n<h3 style="margin-left:200px; text-align:justify">Daisy T-shirt</h3>\r\n\r\n<p style="margin-left:200px; text-align:justify">Black IMIL T-shirt is an ultra-cotton t-shirt. This shirt is preshrunk 100% cotton jersey.</p>\r\n&nbsp;\r\n\r\n<p style="margin-left:200px"><br />\r\n<a href="#"><span style="color:#FF0000">Buy Now!</span></a></p>\r\n&nbsp;</div>\r\n</div>\r\n', 0, 'allproducts', '1');

-- --------------------------------------------------------

--
-- Table structure for table `site_menu`
--

CREATE TABLE IF NOT EXISTS `site_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `description` text NOT NULL,
  `type` enum('category','page','post','external') CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `link_content` int(11) NOT NULL,
  `external_link` varchar(255) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `status` enum('0','1','-1') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `site_menu`
--

INSERT INTO `site_menu` (`menu_id`, `menu_name`, `parent`, `description`, `type`, `link_content`, `external_link`, `menu_order`, `status`) VALUES
(1, 'main_menu', 43, '132131', 'page', 35, '', 6, '-1'),
(2, 'footer_menu', 0, '                            ', 'page', 0, 'Terms and Conditions', 6, '0'),
(43, 'Home', 1, 'Home page for site', 'page', 35, '', 1, '1'),
(44, 'Aboutus', 1, 'aboutus', 'page', 37, '', 2, '1'),
(47, 'Company Milestones', 44, 'Company Milestones', 'external', 0, 'https://www.google.com', 1, '1'),
(48, 'Our History', 44, 'Our History', 'external', 0, 'http://www.aa.com', 3, '1'),
(49, 'Our Role in I am Moving', 44, 'Our Role in I am Moving', 'external', 0, 'http://www.llllllll.com', 3, '1'),
(50, 'Our Staff and Offices', 44, 'Our Staff and Offices', 'page', 42, '', 4, '1'),
(51, 'What Makes us unique', 44, 'What Makes us unique', 'page', 43, '', 5, '1'),
(52, 'Choosy The Health Hero', 1, 'Choosy The Health Hero', 'page', 44, '', 3, '1'),
(53, 'Choosy''s Messages', 52, 'Choosy''s Messages', 'page', 45, '', 1, '-1'),
(54, 'Testimonoals', 52, 'Testimonoals', 'page', 46, '', 2, '1'),
(55, 'The Evolution of Choosy', 52, 'The Evolution of Choosy', 'page', 47, '', 3, '1'),
(56, 'Using a Character as Health Hero', 52, 'Using a Character as Health Hero', 'page', 48, '', 4, '1'),
(57, 'Music', 1, 'Music', 'page', 42, '', 4, '1'),
(58, 'Meet our Artists', 57, 'Meet our Artists', 'page', 50, '', 1, '1'),
(59, 'Testimonials about Choosy Music', 54, 'Testimonials about Choosy Music', 'page', 51, '', 2, '1'),
(60, 'Store', 1, 'Store', 'page', 37, '', 5, '1'),
(61, 'Accessories', 60, 'Accessories', 'category', 0, '', 1, '1'),
(62, 'All Products', 60, 'All Products', 'page', 43, '', 2, '1'),
(63, 'Classroom Resources', 60, 'Classroom Resources', 'category', 0, '', 3, '1'),
(64, 'Music and Video', 60, 'Music and Video', 'category', 0, '', 4, '1'),
(65, 'Product Catalog', 60, 'Product Catalog', 'category', 0, '', 5, '1'),
(66, 'Specials', 60, 'Specials', 'category', 0, '', 6, '1'),
(67, 'T-Shirts', 60, 'T-Shirts', 'category', 0, '', 7, '1'),
(68, 'Training', 1, 'Training', 'page', 61, '', 6, '1'),
(69, 'About our Training', 68, 'About our Training', 'page', 62, '', 1, '1'),
(70, 'Request Training or Speaking Engagement', 68, 'Request Training or Speaking Engagement', 'page', 63, '', 2, '1'),
(71, 'Training Team', 68, 'Training Team', 'page', 65, '', 3, '1'),
(73, 'Training Testimonials', 68, 'Training Testimonials', 'page', 66, '', 4, '1'),
(74, 'Choosy Champions', 1, 'Choosy Champions', 'page', 67, '', 7, '1'),
(75, 'Welcome', 74, 'Welcome', 'page', 68, '', 1, '1'),
(76, 'Bulletin Board', 74, 'Bulletin Board', 'page', 69, '', 2, '1'),
(77, 'Choosy Blog', 74, 'Choosy Blog', 'page', 70, '', 3, '1'),
(78, 'Choosy Kids Club', 74, 'Choosy Kids Club', 'page', 71, '', 4, '1'),
(79, 'Developing Healthy Vocabulary', 74, 'Developing Healthy Vocabulary', 'page', 72, '', 5, '1'),
(80, 'Developing Healthy Vocabulary', 74, 'Developing Healthy Vocabulary', 'page', 72, '', 5, '1'),
(81, 'Developing Motor Skills', 74, 'Developing Motor Skills', 'page', 72, '', 5, '1'),
(82, 'Featured Song and Activities', 74, 'Featured Song and Activities', 'page', 74, '', 7, '1'),
(83, 'Moving and learning with Choosy Nusic', 74, 'Moving and learning with Choosy Nusic', 'page', 75, '', 8, '1'),
(84, 'bharat', 1, 'ssssssssssssss', 'page', 35, '', 1, '-1'),
(85, 'bharat', 1, 'dgdgdgdd', 'page', 35, '', 2, '-1'),
(86, 'dddddddddd', 1, 'dddddd', 'page', 35, '', 1, '-1'),
(87, 'gdggdg', 1, 'ssssssssss', 'page', 35, '', 0, '-1'),
(88, 'test', 1, 'ssss', 'external', 0, 'http://www.google.com', 9, '-1'),
(89, 'ABOUTUS', 1, 'xxxxxx', 'page', 37, '', 2, '-1'),
(90, 'ABOUTUS', 1, 'xxxxxxx', 'page', 37, '', 2, '-1'),
(91, 'Mp3', 60, 'good', 'category', 0, '', 8, '1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(50) NOT NULL,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`StateID`, `StateName`) VALUES
(1, 'ANDHRA PRADESH'),
(2, 'ASSAM'),
(3, 'ARUNACHAL PRADESH'),
(4, 'GUJRAT'),
(5, 'BIHAR'),
(6, 'HARYANA'),
(7, 'HIMACHAL PRADESH'),
(8, 'JAMMU & KASHMIR'),
(9, 'KARNATAKA'),
(10, 'KERALA'),
(11, 'MADHYA PRADESH'),
(12, 'MAHARASHTRA'),
(13, 'MANIPUR'),
(14, 'MEGHALAYA'),
(15, 'MIZORAM'),
(16, 'NAGALAND'),
(17, 'ORISSA'),
(18, 'PUNJAB'),
(19, 'RAJASTHAN'),
(20, 'SIKKIM'),
(21, 'TAMIL NADU'),
(22, 'TRIPURA'),
(23, 'UTTAR PRADESH'),
(24, 'WEST BENGAL'),
(25, 'DELHI'),
(26, 'GOA'),
(27, 'PONDICHERY'),
(28, 'LAKSHDWEEP'),
(29, 'DAMAN & DIU'),
(30, 'DADRA & NAGAR'),
(31, 'CHANDIGARH'),
(32, 'ANDAMAN & NICOBAR'),
(33, 'UTTARANCHAL'),
(34, 'JHARKHAND'),
(35, 'CHATTISGARH');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `mobile` bigint(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` bigint(7) NOT NULL,
  `pics` text NOT NULL,
  `LastLogin` date NOT NULL,
  `Status` int(10) NOT NULL,
  `Ship_Address` varchar(255) NOT NULL,
  `Ship_City` varchar(255) NOT NULL,
  `Ship_State` varchar(255) NOT NULL,
  `Ship_Country` varchar(255) NOT NULL,
  `Ship_Zip` int(11) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `firstname`, `username`, `lastname`, `gender`, `email`, `password`, `bdate`, `mobile`, `address`, `country`, `state`, `city`, `pincode`, `pics`, `LastLogin`, `Status`, `Ship_Address`, `Ship_City`, `Ship_State`, `Ship_Country`, `Ship_Zip`) VALUES
(49, 'demo', 'demo', 'demo1', 'Male', 'demo@gmail.com', '1234567', '1990-12-21', 9723881263, 'dsjhgdas', 'kjnjdskd', 'asdjhdsj', 'ahmedabad', 352516, '29522fgfd.jpg', '2013-11-16', 1, 'dsjhgdas', 'ahmedabad', 'asdjhdsj', 'kjnjdskd', 352516),
(57, 'demo', '', 'test', 'Male', 'demo@yahoo.com', 'demo123', '1965-10-16', 8654785214, '123,apartment', 'uk', 'nc', 'sk', 658947, '', '2013-06-07', 1, '123,apartment', 'sk', 'nc', 'uk', 658947),
(58, 'test', '', 'test1', 'Male', 'test@gmail.com', 'test123', '1967-01-17', 3258451478, 'jhasdyuiasjn', 'uk', 'nc', 'ap', 568411, '', '2013-06-07', 1, 'jhasdyuiasjn', 'ap', 'nc', 'uk', 568411),
(59, 'Deep', '', 'Mehta', 'Male', 'deep@yahoo.com', '1234567', '1950-01-01', 1234567890, 'gdfkakdfg', 'AUSTRALIA', 'VIC', 'ST KILDA', 123456, '', '2013-06-07', 1, 'gdfkakdfg', 'ST KILDA', 'VIC', 'AUSTRALIA', 123456),
(60, 'demo1', '', 'demo2', 'Male', 'test@yahoo.com', 'test1234', '1952-02-02', 3256845154, '1/11 aukland street st kilda melborne vic', 'xyz', 'abc', 'pqr', 3824, '', '2013-06-11', 1, '1/11 aukland street st kilda melborne vic', 'pqr', 'abc', 'xyz', 3824),
(61, 'patel', '', 'bharat', 'Male', 'patel.bharat@gmail.com', 'admin123', '1988-08-23', 7878454545, '', '', '', '', 0, '1100265551user.jpeg', '2013-10-24', 1, '', '', '', '', 0),
(62, 'patel', 'bharat', 'bharat', 'Male', 'patel@gmail.com', 'admin123', '0000-00-00', 0, 'aaaa', 'india', 'gujarat', 'ahmedabad', 382350, '', '2013-11-11', 1, 'aaaa', 'ahmedabad', 'gujarat', 'india', 382350),
(63, 'patel', 'bharat', 'bharat', 'Male', 'laxmi.1989@yahoo.com', '1234567', '0000-00-00', 0, 'ddd', '4545', '4545', '4545', 0, '', '2013-11-08', 1, '', '', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
