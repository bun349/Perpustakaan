-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 05:47 PM
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
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `publisher_name`, `description`, `cover_image`, `category_id`) VALUES
(1, 'The Great Gatsby', 'Scribners', 'A classic novel set in the Jazz Age.s', '1731905774_6bb5760e90f5a6582006.jpg', 1),
(2, 'To Kill a Mockingbird', 'J.B. Lippincott & Co.', 'A novel about racial injustice in the Deep South.', '1731905898_62f3a792d54d0bc19f8f.jpg', 1),
(3, '1984', 'Secker & Warburg', 'A dystopian novel about totalitarianism.', '1731905940_aa1d830c43938279fef4.jpg', 1),
(4, 'The Catcher in the Rye', 'Little, Brown and Company', 'A story about teenage angst and alienation.', '1731905990_3b254d576fc5c50799e6.jpg', 1),
(5, 'Pride and Prejudice', 'T. Egerton', 'A romantic novel about manners and social mobility.', '1731906017_d6f299731eacff9c434b.jpg', 1),
(6, 'Moby-Dick', 'Harper & Brothers', 'A novel about the voyage of the whaling ship Pequod.', '1731906244_568ed67486cbab17ebf8.jpg', 1),
(7, 'War and Peace', 'The Russian Messenger', 'A novel that chronicles the French invasion of Russia.', '1731906491_b951ba8760205abe5271.jpg', 1),
(8, 'The Hobbit', 'George Allen & Unwin', 'A fantasy novel about Bilbo Baggins\' adventure.', '1731906554_fe6326663a69fc12177d.jpg', 1),
(10, 'Jane Eyre', 'Smith, Elder & Co.', 'A novel about the life and growth of an orphaned girl.', '1731906645_9b3152d5f6eb44a87dd0.jpg', 1),
(11, 'The Odyssey', 'Ancient Greek Publisher', 'An epic poem attributed to Homer.', '1731906878_4add0593571b2bdc2180.jpg', 1),
(12, 'Sapiens: A Brief History of Humankind', 'Harper', 'A journey through the history of humankind.', '1732278151_dcd5eda2a5f291170848.jpg', 2),
(13, 'Educated', 'Random House', 'A memoir of overcoming a strict upbringing and achieving education.', '1732278218_8252394113451db98a55.jpg', 2),
(14, 'Becoming', 'Crown', 'The memoir of Michelle Obama.', '1732278265_224df9b94db69b3828a5.jpg', 2),
(15, 'The Righteous Mind', 'Jonathan Haidt', 'The Righteous Mind: Why Good People are Divided by Politics and Religion is a 2012 social psychology book by Jonathan Haidt, in which the author describes human morality as it relates to politics and religion', '1731729731_6e8d31c384a38f267d6e.jpg', 2),
(16, 'The Immortal Life of Henrietta Lacks', 'Crown', 'The story of Henrietta Lacks and the HeLa cells.', '1732278298_4f3515fccf39acc75cbb.jpg', 2),
(17, 'A Brief History of Time', 'Bantam Books', 'An introduction to cosmology by Stephen Hawking.', '1732278330_cf738f2d61400b802648.jpg', 2),
(18, 'The Diary of a Young Girl', 'Contact Publishing', 'The personal diary of Anne Frank during WWII.', '1732278383_8f6a59d3eddb2618085f.jpg', 2),
(19, 'Born a Crime', 'Spiegel & Grau', 'Trevor Noah\'s memoir about growing up in South Africa.', '1732278408_1ce90baf536b689e919c.jpg', 2),
(20, 'Why We Sleep', 'Scribner', 'The science behind sleep and its importance.', '1732278429_109ecf95fdd67452b9c7.jpg', 2),
(21, 'Thinking, Fast and Slow', 'Farrar, Straus and Giroux', 'An exploration of the human mind and decision-making.', '1732278614_52ec63c0546ef8a149ba.jpg', 2),
(22, 'Man\'s Search for Meaning', 'Beacon Press', 'A memoir by Viktor Frankl about finding purpose in the face of suffering.', '1732278636_0ffe4d49e1556e3a4a13.jpg', 2),
(23, 'The Alchemist', 'HarperOne', 'A philosophical novel about following one\'s dreams and finding one\'s destiny.', '1732276975_d78f9f694183d7605050.jpg', 1),
(25, 'Atomic Habits', 'Avery', 'An insightful guide on how small habits can lead to remarkable results.', '1732278671_669b4cc8f0826b2ff2ad.jpg', 2),
(26, 'The Night Circus', 'Doubleday', 'A magical story about a mysterious circus that appears without warning.', '1732278084_3cfc1eb6d791a994133f.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `book_id`, `user_id`, `borrow_date`, `return_date`, `status`) VALUES
(16, 2, 3, '2024-11-24', '2024-11-24', 'borrowed'),
(17, 7, 3, '2024-11-24', '2024-11-24', 'borrowed'),
(18, 19, 3, '2024-11-24', '2024-12-01', 'borrowed'),
(19, 2, 3, '2024-11-24', NULL, 'borrowed'),
(20, 4, 3, '2024-11-24', NULL, 'borrowed'),
(21, 8, 1, '2024-11-25', '2024-11-25', 'borrowed'),
(22, 3, 6, '2024-11-30', NULL, 'borrowed'),
(23, 4, 6, '2024-12-01', '2024-12-02', 'borrowed'),
(24, 11, 8, '2024-12-02', '2024-12-02', 'borrowed'),
(25, 5, 6, '2024-12-02', NULL, 'borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Fiksi'),
(2, 'NonFiksi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `username` varchar(50) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `username`, `remember_token`) VALUES
(1, 'bunga05adlyna@gmail.com', '$2y$10$rJT6Nt3l768.29SkqPM5fuv3RD9ZuNWGczO21VWLYYDWWQ4qxOg7.', 'user', '', NULL),
(2, 'admin@gmail.com', '$2y$10$3NVn1oLwzRGUqMCF6NO.nuShdF.Li28zqWmOoCqJCL20XW1EEncoq', 'admin', 'admin', '6bc0922cb663be90a9640b0813830f00'),
(3, 'user@gmail.com', '$2y$10$/8Muxst2iLCKYUzE5xfhsOTBxDLzLBdsYXeWnxY78AsJaLLYSsjCK', 'user', '', NULL),
(4, 'user123@gmail.com', '$2y$10$mNnDG4vyvWoy59Zm5THRjeMbo9D6t/cb/6loHemgeLvXQ7.chnLy2', 'user', '', NULL),
(6, 'bunga23006@mail.unpad.ac.id', '$2y$10$jCXhdJGowf3WWu7/SzEZyeAOs/yifPMt0ntdb71o3RRNLSzS1CPLa', 'user', 'bunga', 'b5b319e25da648664ff4dd3af5d9dfc6'),
(7, 'admin1@gmail.com', '$2y$10$d46PG7uL635h6SkMNcZDoeg7SngBKeRwEpIAOd03HUM9m0VV/8Hx2', 'user', 'admin1', NULL),
(8, 'han@gmail.com', '$2y$10$mzjWOGWWRdJReMLTwp4VnuyjDI/3OC/rOUP8i70i0GfkdDLYhrxc.', 'user', 'hana', NULL),
(9, 'hak@gmail.com', '$2y$10$ccEiJZRgU.fxizZYbatyleZDzNwEkG0njp06YNWu4dmYUaujlLcy.', 'user', 'hak', NULL),
(10, 'admin123@gmail.com', '$2y$10$vnejX0eCwktSUhNXefjbXO99vn3LKGb/AmwiMGOh3hQK4zbiT89Ne', 'user', 'adm', NULL),
(11, 'bunga25@gmail.com', '$2y$10$IwU9rG3WVPhZp4izeSegguOaM96vOr9vY5rFjlIP8KApa2RFUOIBu', 'user', 'bunga23', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_books`
-- (See below for the actual view)
--
CREATE TABLE `v_books` (
`book_id` int(11)
,`title` varchar(100)
,`description` text
,`cover_image` varchar(255)
,`category_id` int(11)
,`category_name` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `v_books`
--
DROP TABLE IF EXISTS `v_books`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_books`  AS SELECT `books`.`book_id` AS `book_id`, `books`.`title` AS `title`, `books`.`description` AS `description`, `books`.`cover_image` AS `cover_image`, `books`.`category_id` AS `category_id`, `categories`.`category_name` AS `category_name` FROM (`books` join `categories` on(`books`.`category_id` = `categories`.`category_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `idx_category_id` (`category_id`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_category_title` (`category_id`,`title`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_books_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
