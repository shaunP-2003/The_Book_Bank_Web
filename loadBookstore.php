<?php
// Include the database connection file
	include 'dbConn.php';

// Function to execute SQL query
function executeQuery($conn, $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Query executed successfully.<br>";
    } else {
        echo "Error executing query: " . $conn->error . "<br>";
    }
}

// Drop tables if they exist
$tables = ['userstbl', 'bookstbl', 'orderstbl', 'admintbl'];

foreach ($tables as $table) {
    $dropTableSQL = "DROP TABLE IF EXISTS $table";
    executeQuery($conn, $dropTableSQL);
}

// Create userstbl table
$userstblSQL = "
CREATE TABLE IF NOT EXISTS userstbl (
  student_id varchar(50) NOT NULL,
  s_name varchar(100) NOT NULL,
  s_surname varchar(100) NOT NULL,
  campus varchar(50) NOT NULL,
  s_email varchar(100) NOT NULL,
  password varchar(225) NOT NULL,
  reg_approval varchar(50) NOT NULL,
  PRIMARY KEY (student_id)
)";

executeQuery($conn, $userstblSQL);
 ///The following method was taken from Youtube
            // Author: Alimon Pito
            //Link: https://youtu.be/sjF7A_uMbgc
// Populate userstbl with fictitious entries from text file
$userstblFile = fopen('userstbl_data.txt', 'r');

if ($userstblFile) {
    // Read the file line by line until the end
    while (!feof($userstblFile)) {
        // Read a line from the file
        $line = fgets($userstblFile);

        // Split the line into values
        $values = explode(',', $line);
        
        // Create a list of variables
        list($student_id, $s_name, $s_surname, $campus, $s_email, $password, $reg_approval) = $values;

        // Insert the values into the userstbl table
        $insertUserstblSQL = "INSERT INTO userstbl (student_id, s_name, s_surname, campus, s_email, password, reg_approval) 
                              VALUES ('$student_id', '$s_name', '$s_surname', '$campus', '$s_email', '$password', '$reg_approval')";

        executeQuery($conn, $insertUserstblSQL);
    }

    // Close the file
    fclose($userstblFile);
}

    

// Create bookstbl table
$bookstblSQL = "
CREATE TABLE IF NOT EXISTS bookstbl (
  book_id int NOT NULL AUTO_INCREMENT,
  bookTitle varchar(100) NOT NULL,
  author varchar(255) NOT NULL,
  ISBN varchar(20) NOT NULL,
  genre varchar(255) NOT NULL,
  description text NOT NULL,
  edition varchar(50) NOT NULL,
  price float NOT NULL,
  bookImage varchar(255) NOT NULL,
  PRIMARY KEY (book_id)
)";

executeQuery($conn, $bookstblSQL);

// Populate bookstbl with fictitious entries from text file
$insertBookstblSQL = "INSERT INTO bookstbl (book_id, bookTitle, author, ISBN, genre, description, edition, price, bookImage) VALUES 
(1, 'Python Programming: A Step By Step Guide From Beginner To Expert', 'Anthony Brun', '1790312736', 'Programming', '\"Python Programming: A Step By Step Guide From Beginner To Expert\" is a comprehensive and accessible book designed to take you on a journey from a complete novice to an accomplished Python programmer. This practical guide provides clear explanations, hands-on examples, and progressive exercises that gradually build your skills and confidence. Whether you are new to programming or have some experience, this book equips you with the knowledge and techniques needed to become proficient in Python programming and tackle real-world coding challenges.', 'Kindle Edition ', 359.9, 'Images\\PhythonTxtBook.jpg'),
(2, 'Head First Java: A Brain-Friendly Guide ', ' Kathy Sierra, Bert Bates, Trisha Gee ', '1491910771', 'Programming', 'Head First Java is a complete learning experience in Java and object-oriented programming. With this book, you\'ll learn the Java language with a unique method that goes beyond how-to manuals and helps you become a great programmer. Through puzzles, mysteries, and soul-searching interviews with famous Java objects, you\'ll quickly get up to speed on Java\'s fundamentals and advanced topics including lambdas, streams, generics, threading, networking, and the dreaded desktop GUI. ', '3rd', 825.72, 'Images\\JavaTxtbook.jpg'),
(3, 'Database Principles: Fundamentals of Design, Implementation, and Management ', 'CARLOS CORONEL, STEVEN MORRIS', '9781473768048', 'Databases Textbooks', '\"Database Principles: Fundamentals of Design, Implementation, and Management\" is a comprehensive textbook that covers the essential principles and techniques involved in designing, implementing, and managing databases. Suitable for both beginners and intermediate learners, this book provides a solid foundation in database concepts, data modeling, normalization, and database design. It explores various database management systems (DBMS) and their functionalities, including data storage, retrieval, and manipulation. The book also delves into important topics like database security, transaction management, and query optimization. With a practical approach and real-world examples, \"Database Principles\" equips readers with the knowledge and skills necessary to create efficient, secure, and well-designed databases.', '3rd', 1005, 'Images\\databaseTextbok.jfif');"

 

executeQuery($conn, $insertBookstblSQL);



// Create orderstbl table
$orderstblSQL = "
CREATE TABLE IF NOT EXISTS orderstbl (
  order_id int NOT NULL,
  student_id varchar(50) NOT NULL,
  book_id int NOT NULL,
  order_date date NOT NULL,
  total_price float NOT NULL,
  PRIMARY KEY (order_id),
  KEY link (book_id),
  KEY link_student (student_id),
  CONSTRAINT link FOREIGN KEY (book_id) REFERENCES bookstbl (book_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT link_student FOREIGN KEY (student_id) REFERENCES userstbl (student_id) ON DELETE CASCADE ON UPDATE CASCADE
)";

executeQuery($conn, $orderstblSQL);

// Create admintbl table
$admintblSQL = "
CREATE TABLE IF NOT EXISTS admintbl (
  admin_Id int NOT NULL AUTO_INCREMENT,
  admin_username varchar(50) NOT NULL,
  admin_password varchar(225) NOT NULL,
  PRIMARY KEY (admin_Id)
)";

executeQuery($conn, $admintblSQL);

// Populate admintbl with fictitious entry
$insertAdmintblSQL = "INSERT INTO `admintbl` (`admin_Id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'SCAR1234')";

executeQuery($conn, $insertAdmintblSQL);

// Close the database connection
$conn->close();
?>
