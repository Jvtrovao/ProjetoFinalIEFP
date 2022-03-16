-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 08:47 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_market`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetCategory` ()  BEGIN
SELECT * FROM t_category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductById` (IN `prod_insert` INT(11))  BEGIN
SELECT * FROM `t_product` WHERE id = prod_insert;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProducts` ()  BEGIN
SELECT product.*, cat.category FROM t_product product INNER JOIN t_category cat on cat.id = product.idCategory GROUP BY idCategory, name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductsByName` (IN `product_insert` VARCHAR(255))  BEGIN
SELECT product.*, cat.category FROM t_product product INNER JOIN t_category cat on cat.id = product.idCategory WHERE name LIKE CONCAT(product_insert,'%') GROUP BY idCategory, name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetProductsCat` (IN `cat_insert` INT(11))  BEGIN
SELECT product.*, cat.category FROM t_product product INNER JOIN t_category cat on cat.id = product.idCategory WHERE product.idCategory = cat_insert GROUP BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `name_insert` VARCHAR(50), IN `price_insert` FLOAT(8), IN `stock_insert` INT(11), IN `photo_insert` VARCHAR(255), IN `idCategory_insert` INT(11))  BEGIN
INSERT INTO `t_product`(`name`, `price`, `stock`, `photo`, `idCategory`) VALUES (name_insert ,price_insert ,stock_insert ,photo_insert ,idCategory_insert);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct` (IN `name_insert` VARCHAR(50), IN `price_insert` FLOAT(8), IN `stock_insert` INT(11), IN `photo_insert` VARCHAR(255), IN `idCategory_insert` INT(11), IN `id_insert` INT(11))  BEGIN
UPDATE t_product SET name = name_insert , price = price_insert , stock = stock_price ,photo = photo_insert ,idCategory = idCategory_insert WHERE id = id_insert;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProductInativeStatus` (IN `inative_insert` INT(11), IN `id_insert` INT(11))  BEGIN
UPDATE t_product SET Inative= inative_insert WHERE id = id_insert;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProductNP` (IN `name_insert` VARCHAR(50), IN `price_insert` FLOAT(8), IN `stock_insert` INT(11), IN `idCategory_insert` INT(11), IN `id_insert` INT(11))  BEGIN
UPDATE t_product SET name = name_insert , price = price_insert , stock = stock_insert ,idCategory = idCategory_insert WHERE id = id_insert;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_category`
--

INSERT INTO `t_category` (`id`, `category`) VALUES
(1, 'Fruit'),
(2, 'Grain'),
(3, 'Vegetable'),
(4, 'Protein'),
(5, 'Dairy'),
(6, 'Beverage'),
(7, 'Alcoholic beverage');

-- --------------------------------------------------------

--
-- Table structure for table `t_client`
--

CREATE TABLE `t_client` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `NIF` varchar(9) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `balance` float NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_client`
--

INSERT INTO `t_client` (`id`, `name`, `NIF`, `email`, `adress`, `contact`, `balance`, `points`) VALUES
(1, 'John', '123456789', 'email@veridico.com', 'Rua qualquer', '111222334', 0, 0),
(2, 'Zoey', '987654321', 'email2@veridico.com', 'Rua qualquer uma', '22233344455', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice`
--

CREATE TABLE `t_invoice` (
  `id` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_invoice_lines`
--

CREATE TABLE `t_invoice_lines` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `quatity` int(11) NOT NULL,
  `idInvoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_product`
--

CREATE TABLE `t_product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `Inative` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_product`
--

INSERT INTO `t_product` (`id`, `name`, `price`, `stock`, `photo`, `idCategory`, `Inative`) VALUES
(1, 'Banana d\'água', 1.99, 50, '', 1, 0),
(2, 'Rice White', 1.49, 60, '', 2, 0),
(3, 'Rice Deluxe White', 2.99, 47, '', 2, 0),
(4, 'Leeks, Japanese', 1.39, 78, '', 3, 0),
(5, 'Corn, American grade', 2.49, 24, '', 3, 0),
(6, 'Chocolate Ice cream Cones x6', 2.49, 36, '', 5, 0),
(7, 'Modelo, 120ml, x6', 4.59, 12, '', 7, 0),
(8, 'Grape Juice, Italian', 0.99, 46, '', 6, 0),
(9, 'Orange Juice 100% pulp', 1.19, 68, '', 6, 0),
(10, 'Chocolate', 1.99, 5, '', 6, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_client`
--
ALTER TABLE `t_client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIF` (`NIF`);

--
-- Indexes for table `t_invoice`
--
ALTER TABLE `t_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_invoice_lines`
--
ALTER TABLE `t_invoice_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_product`
--
ALTER TABLE `t_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_client`
--
ALTER TABLE `t_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_invoice`
--
ALTER TABLE `t_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_invoice_lines`
--
ALTER TABLE `t_invoice_lines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_product`
--
ALTER TABLE `t_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
