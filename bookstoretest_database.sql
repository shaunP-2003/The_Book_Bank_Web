-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2023 at 04:38 PM
-- Server version: 8.0.32
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstoretest`
--

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`admin_Id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'SCAR1234');

--
-- Dumping data for table `bookstbl`
--

INSERT INTO `bookstbl` (`book_id`, `bookTitle`, `author`, `ISBN`, `genre`, `description`, `edition`, `price`, `bookImage`) VALUES
(1, 'Python Programming: A Step By Step Guide From Beginner To Expert', 'Anthony Brun', '1790312736', 'Programming', '\"Python Programming: A Step By Step Guide From Beginner To Expert\" is a comprehensive and accessible book designed to take you on a journey from a complete novice to an accomplished Python programmer. This practical guide provides clear explanations, hands-on examples, and progressive exercises that gradually build your skills and confidence. Whether you are new to programming or have some experience, this book equips you with the knowledge and techniques needed to become proficient in Python programming and tackle real-world coding challenges.', 'Kindle Edition ', 359.9, 'Images\\PhythonTxtBook.jpg'),
(2, 'Head First Java: A Brain-Friendly Guide ', ' Kathy Sierra, Bert Bates, Trisha Gee ', '1491910771', 'Programming', 'Head First Java is a complete learning experience in Java and object-oriented programming. With this book, you\'ll learn the Java language with a unique method that goes beyond how-to manuals and helps you become a great programmer. Through puzzles, mysteries, and soul-searching interviews with famous Java objects, you\'ll quickly get up to speed on Java\'s fundamentals and advanced topics including lambdas, streams, generics, threading, networking, and the dreaded desktop GUI. ', '3rd', 825.72, 'Images\\JavaTxtbook.jpg'),
(3, 'Database Principles: Fundamentals of Design, Implementation, and Management ', 'CARLOS CORONEL, STEVEN MORRIS', '9781473768048', 'Databases Textbooks', '\"Database Principles: Fundamentals of Design, Implementation, and Management\" is a comprehensive textbook that covers the essential principles and techniques involved in designing, implementing, and managing databases. Suitable for both beginners and intermediate learners, this book provides a solid foundation in database concepts, data modeling, normalization, and database design. It explores various database management systems (DBMS) and their functionalities, including data storage, retrieval, and manipulation. The book also delves into important topics like database security, transaction management, and query optimization. With a practical approach and real-world examples, \"Database Principles\" equips readers with the knowledge and skills necessary to create efficient, secure, and well-designed databases.', '3rd', 1005, 'Images\\databaseTextbok.jfif');

--
-- Dumping data for table `userstbl`
--

INSERT INTO `userstbl` (`student_id`, `s_name`, `s_surname`, `campus`, `s_email`, `password`, `reg_approval`) VALUES
('ST100', 'Sydney', 'Lombard', 'Up', 'syds04@gmail.com', '$2y$10$eANShM7O8SrxW5I4dJDL3uapUK02fLMiTY7QUcbmEOfzTRGac5mUW', 'Approved'),
('ST100002', 'Jane', 'Smith', 'VC Durban North', 'jane@gmail.com', '$2y$10$9CgqdhFoc10/WavAeAIumuKEbs0G2vFmF80Ds6L10vQfEWz6ylVt6', 'Pending'),
('ST100003', 'Mike', 'Johnson', 'VC Cape Town', 'mike@gmail.com', '$2y$10$3oATEr1Fx2KoENDXoQd/w.xzLLx1m4RNZO2PmVjkQNO7kxZUBLFZu', 'Pending'),
('ST100004', 'Sarah', 'Williams', 'VC Cape Town', 'sarah@gmail.com', '$2y$10$nkZiBo12jPzI1o3LiQlSReJ0NMdFuZXMgO51Cxp3lidc1YRTGr/c6', 'Pending'),
('ST100005', 'David', 'Brown', 'VC Pretoria', 'david@gmail.com', '$2y$10$hwjIOv08SwJ65qVSjhuxUu5nw2e40ryyR5rAqep0L4j3Ceh8reCSm', 'Pending');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
