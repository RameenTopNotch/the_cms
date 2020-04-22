-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2020 at 07:48 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(5) NOT NULL,
  `cat_name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'love'),
(2, 'work'),
(3, 'education'),
(4, 'society'),
(5, 'freedom');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_post_id` int(5) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `comment_writer` char(255) DEFAULT NULL,
  `comment_email` char(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` char(255) NOT NULL DEFAULT 'unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_date`, `comment_writer`, `comment_email`, `comment_content`, `comment_status`) VALUES
(1, 1, '2020-04-20 19:32:01', 'topnotch', 'veryscholar@gmail.com', 'This is nice!', 'approved'),
(2, 1, '2020-04-20 19:38:55', 'queen', 'queen@email.com', 'very nice!', 'approved'),
(3, 7, '2020-04-21 10:08:05', 'topnotch', 'veryscholar@gmail.com', 'This is nice!', 'approved'),
(4, 10, '2020-04-21 17:06:39', 'john', 'john@gmail.com', 'this is sad!', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(5) NOT NULL,
  `post_cat_id` int(5) NOT NULL,
  `post_title` char(255) NOT NULL,
  `post_author` char(255) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_picture` char(255) NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` text NOT NULL,
  `post_comment_count` int(5) NOT NULL DEFAULT 0,
  `post_status` char(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_picture`, `post_content`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(1, 1, 'love can save us', 'ramin', '2020-04-18 21:34:05', 'love.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'love, life, family, happiness, marriage, people, home', 2, 'published'),
(2, 2, 'A nice job is good for health', 'ramin', '2020-04-18 21:36:45', 'team.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'work, people, society, life, happiness\r\n', 0, 'published'),
(3, 3, 'Good education for good future', 'ramin', '2020-04-18 21:36:45', 'education.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'school, teacher, student, life, future, education', 0, 'published'),
(4, 4, 'People should take care of each other', 'ramin', '2020-04-18 21:39:20', 'society.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'society, life, people, happiness, welfare, government', 0, 'published'),
(5, 5, 'Is there anything more valuable than freedom?', 'ramin', '2020-04-18 21:39:20', 'yacht.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'freedom, happiness, people, life, money', 0, 'published'),
(6, 1, 'You should take care of love like a tree', 'ramin', '2020-04-18 21:44:41', 'tree_of_love.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'love, life, people, happiness, home, health', 0, 'published'),
(7, 2, 'work is essential for sanity', 'ramin', '2020-04-18 21:44:41', 'worker.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'money, labor, society, hardship, man, family, inequality, home, wife, husband', 1, 'published'),
(8, 3, 'Education should be free', 'ramin', '2020-04-18 21:48:42', 'school.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'school, society, education, future, welfare, economy, equality', 0, 'published'),
(9, 5, 'Be free like an eagle', 'ramin', '2020-04-18 21:48:42', 'eagle.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 'freedom, life, man, society, happiness, slavery, nature', 0, 'published'),
(10, 4, 'Poverty is ubiquitous, society has become a den of thieves', 'ramin', '2020-04-18 21:53:51', 'poverty.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'society, wealth, economy, people, money, equality, inequality, government', 1, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `user_firstname` char(255) NOT NULL,
  `user_lastname` char(255) NOT NULL,
  `user_photo` char(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `role` char(255) NOT NULL DEFAULT 'subscriber',
  `email` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `user_firstname`, `user_lastname`, `user_photo`, `user_id`, `role`, `email`) VALUES
('topnotch', '$2y$10$hzxg3aeZYFegVYRJ2qdl4OihKeT0GLXzPs.yB6noSPi6k77IIBmVi', 'ramin', 'alikhani', 'rameen_image.jpeg', 1, 'admin', 'veryscholar@gmail.com'),
('queen', '$2y$10$KTUolYONOqfaMwq2LYu.6uEl.qfrJ7JalrqUMzkpJT6LmHr2zEpS6', 'nassin', 'ghazili', 'elena koshka.jpg', 2, 'subscriber', 'queen@email.com'),
('wisewoman', '$2y$10$CZwQ6GVKRXZYeyPgymnn9uXb6092uSyStRO2xYCrumn0wgLXYHmuu', 'mina', 'mobini', 'chick.jpg', 3, 'subscriber', 'mina@gmail.com'),
('ahmad007', '$2y$10$S5pkAOls3mPfXS4/c30MTu8XnYJRbNhYER9rR3kG3aqf3EroDtX4G', 'ahmad', 'najafi', 'dude.jpg', 4, 'subscriber', 'ahamad@gmail.com'),
('price', '$2y$10$78n4312LFgVcV.8kwbF5UegFaAHIBvjDXOOARg0pn7bXDqu9OI0Mq', 'topnotch', 'price', 'BJ_Blazkowicz.png', 5, 'subscriber', 'jack@gmail.com'),
('soap', '$2y$10$uqSvGnXWDfjoGWXxjQmed.MVeiIr9qthNcf.3V8ZNl797wqUENsTi', 'jack', 'price', 'BJ_Blazkowicz.png', 6, 'subscriber', 'price@gmail.com'),
('john', '$2y$10$A0P9NC.i2WDe7bfMgk96fu1lZLHajHwN5.e.7GGRmPzaDtAUO8T5K', 'john', 'lock', 'BJ_Blazkowicz.png', 7, 'subscriber', 'john@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_post_id` (`comment_post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_cat_id` (`post_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_cat_id`) REFERENCES `categories` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
