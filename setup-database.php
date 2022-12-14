<?php

$DB_SERVER = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';

// Connect to mysqli
$conn = new mysqli($DB_SERVER,$DB_USER,$DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql_database = "CREATE DATABASE IF NOT EXISTS navstevnikniha";
if ($conn->query($sql_database) === TRUE) {
  echo "Database created successfully<br>";
} else {
  echo "Error creating database: " . $conn->error;
}

// sql to create table
$sql_table = "CREATE TABLE IF NOT EXISTS navstevnikniha.navstevnikniha (
id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
autor varchar(50) NOT NULL,
email varchar(70) NOT NULL,
obsah varchar(250) NOT NULL,
`datum` datetime NOT NULL DEFAULT current_timestamp()
)";

if ($conn->query($sql_table) === TRUE) {
  echo "Table navstevnikniha created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO navstevnikniha.navstevnikniha (autor, email, obsah, datum)
VALUES
('Adam Vojtěch', 'vojtech@ano.cz', 'Ahoj Martine, tahle návštěvní kniha je naprosto boží. Jen tak dál.', '2022-12-11 13:23:44'),
('Lukáš Nový', 'lukas.novy@seznam.cz', 'Návštívil jsem tvé webové stránky a dokonce obsahují návštěvní knihu. Jak kdybych byl v nějaké turistické budově. To je cool.', '2021-12-11 15:15:15'),
('Otakar Synek', 'synator@centrum.cz', 'Koukám, že když tyto stránky návštívil někdo z hnutí ANO, tak jsem musel taky. ', '2022-12-13 15:20:11'),
('Ondřej Brzobohatý', 'ondra-gregor@atlas.cz', 'Neboj, nejsem z hnutí ANO a ani jej nemám v lásce. Návštěvní kniha vypadá dobře, tak se nedej odradit.', '2022-12-11 13:23:44'),
('Jakub Novák', 'jakub@novakovi.cz', 'Tuto návštěvní knihu navštívil Jakub Novák.', '2022-12-15 10:20:30');
";


if ($conn->query($sql) === TRUE) {
  echo "New records screated successfully<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
