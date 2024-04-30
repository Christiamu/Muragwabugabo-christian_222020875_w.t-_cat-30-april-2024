-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 02:09 AM
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
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(11) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `Genre` varchar(10) NOT NULL,
  `Author` varchar(30) DEFAULT NULL,
  `Publisher` varchar(30) DEFAULT NULL,
  `Shelf` varchar(5) NOT NULL,
  `Row` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookID`, `BookName`, `Genre`, `Author`, `Publisher`, `Shelf`, `Row`) VALUES
(3, 'Harry Potter and Goblet of Fire', 'Fiction', 'J. K. Rowling', 'Pottermore', '12', 'B'),
(4, 'Harry Potter and Deathly Hallow', 'Fiction', 'J. K. Rowling', 'Pottermore', 'D', '23'),
(5, 'Famous Five', 'sd', 'ds', 'dsd', 'A', '3'),
(6, 'akhjkd', 'hdfdj', 'jkshdkjh', 'hkjdfh', 'hj', 'd'),
(13, 'The da Vinci Code', 'Thriller', 'Dan Brown', 'Doubleday', 'r', '5'),
(14, 'Pride and Prejudice', 'Romantic', 'Alexander Dumas', 'Pearson', 'a', '9'),
(15, 'To Kill A Mocking Bird', 'Emotional', 'Harper Lee', 'McGraw', 'z', '8'),
(16, 'The Perks Of being A Wallflower', 'Drama', 'Stephen Chbosky', 'Klett', 'g', '1'),
(17, 'The Hunger Games', 'Action', 'Suzanne Collins', 'Pearson', 't', '7'),
(18, 'Madhushala', 'Life', 'H R Bacchan', 'Pushpalata', 'h', '6'),
(19, 'V for Vendetta ', 'Action', 'Alan Moore', 'Cambridge', 'a', '9');

-- --------------------------------------------------------

--
-- Table structure for table `book_count`
--

CREATE TABLE `book_count` (
  `BookNo` int(11) DEFAULT 0,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `book_count`
--

INSERT INTO `book_count` (`BookNo`, `UserID`) VALUES
(1, 1),
(2, 2),
(0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `fullname`
--

CREATE TABLE `fullname` (
  `UserID` int(11) DEFAULT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fullname`
--

INSERT INTO `fullname` (`UserID`, `FirstName`, `LastName`) VALUES
(0, 'MURERWA', 'DIDDIER');

-- --------------------------------------------------------

--
-- Table structure for table `issuedbook`
--

CREATE TABLE `issuedbook` (
  `BookID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IssueDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `issuedbook`
--

INSERT INTO `issuedbook` (`BookID`, `UserID`, `IssueDate`, `ReturnDate`) VALUES
(5, 1, '2016-11-17', '2016-12-02'),
(12, 2, '2016-11-17', '2016-12-02'),
(6, 2, '2016-11-17', '2016-12-02');

--
-- Triggers `issuedbook`
--
DELIMITER $$
CREATE TRIGGER `IssuedBook_AFTER_INSERT` AFTER INSERT ON `issuedbook` FOR EACH ROW BEGIN
 UPDATE Book_Count 
  SET BookNo = BookNo+1
  where UserID = NEW.UserID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `count` AFTER DELETE ON `issuedbook` FOR EACH ROW BEGIN
  UPDATE Book_Count 
  SET BookNo = BookNo-1
  where Book_Count.UserID = OLD.UserID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `issuedmagazine`
--

CREATE TABLE `issuedmagazine` (
  `MagID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `IssueDate` date NOT NULL,
  `ReturnDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `issuedmagazine`
--
DELIMITER $$
CREATE TRIGGER `IssuedMagazine_AFTER_DELETE` AFTER DELETE ON `issuedmagazine` FOR EACH ROW BEGIN
UPDATE Book_Count
SET BookNo = BookNo
where Book_Count.UserID = OLD.UserID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `IssuedMagazine_AFTER_INSERT` AFTER INSERT ON `issuedmagazine` FOR EACH ROW BEGIN
UPDATE Book_Count
SET BookNo = BookNo +1 
where Book_Count.UserID = NEW.UserID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `LibrarianID` int(11) NOT NULL,
  `FullName` varchar(30) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`LibrarianID`, `FullName`, `UserName`, `Password`, `Email`) VALUES
(1, 'Enco Sier', 'Encosier', '1234', 'enco.cs.doc@gmail.com'),
(2, 'Leloush Britannia', 'Zero', '9876', 'leloush.zero@bitannia.com');

-- --------------------------------------------------------

--
-- Table structure for table `magazine`
--

CREATE TABLE `magazine` (
  `MagID` int(11) NOT NULL,
  `VolNo` int(11) NOT NULL,
  `Mname` varchar(30) NOT NULL,
  `Magazine` varchar(30) NOT NULL,
  `MagazineShelf` varchar(10) NOT NULL,
  `Genre` varchar(10) NOT NULL,
  `Publisher` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `magazine`
--

INSERT INTO `magazine` (`MagID`, `VolNo`, `Mname`, `Magazine`, `MagazineShelf`, `Genre`, `Publisher`) VALUES
(1, 33, 'wertghj', 'sdfghj', '', 'dfgh', 'trtrtrstdy'),
(2, 33, 'wertghj', 'sdfghj', '', 'dfgh', '0ytresrty'),
(3, 555, 'rrr', 'gg', '', 'tttt', 'gfdsfgh');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `PublisherID` int(11) NOT NULL,
  `PublisherName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`PublisherID`, `PublisherName`) VALUES
(1, 'hjkhdkj'),
(2, 'Pottermore'),
(3, 'dsd'),
(4, 'Whittaker'),
(5, 'ewhkje'),
(6, 'dhskj'),
(7, 'hkjdfh'),
(8, 'gsjf'),
(9, 'dshh'),
(10, 'gdsh'),
(11, 'Water'),
(12, 'ew'),
(13, 'dgjs'),
(14, 'SGAJ'),
(15, 'WHOKNOW'),
(16, 'Doubleday'),
(17, 'Pearson'),
(18, 'McGraw'),
(19, 'Klett'),
(20, 'Pushpalata'),
(21, 'Cambridge'),
(44, 'h');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Christia ', 'muragwabugabo', 'uuuuu', 'christia@gmail.com', '098765432', '$2y$10$0vDLgyBhfILk3vnbkj2UhubpIB4em8z2CzOwqvuSBeWRbzTElVGq2', '2024-04-27 17:31:47', '4', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`LibrarianID`);

--
-- Indexes for table `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`MagID`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PublisherID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `LibrarianID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `magazine`
--
ALTER TABLE `magazine`
  MODIFY `MagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
