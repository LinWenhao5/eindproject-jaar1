DROP DATABASE IF EXISTS `nsp`; 
CREATE DATABASE `nsp`;
USE `nsp`;

Create table `code`(
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR (1000) NOT NULL,
    taal VARCHAR(100) NOT NULL
);

Insert into `code` (`text` ,`taal`) values
('<?php
for ($i = 10; $i >= 1; $i--) {
    echo $i . PHP_EOL;
}
?>', 'PHP'),
('<?php
if ($a > $b) {
    echo "a is bigger than b";
}
?>', 'PHP'),
('<!DOCTYPE html>
<html>
    <head>
        <title>Page Title</title>
    </head>
    <body>
        <h1>This is a Heading</h1>
        <p>This is a paragraph.</p>
    </body>
</html>', 'HTML'),
('<script>
var cars = ["BMW", "Volvo", "Saab", "Ford", "Fiat", "Audi"];
var text = "";
var i;
for (i = 0; i < cars.length; i++) {
    text += cars[i] + "<br>";
}
document.getElementById("demo").innerHTML = text;
</script>', 'JS'),
('#include <stdio.h>
int main() {
    printf("Hello, World!");
    return 0;
}', 'C');

Create table `leaderBoard`(
    id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    score int (100) NOT NULL,
    naam varchar (50) NOT NULL,
    taal varchar (50) NOT NULL
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into `users` (`username`, `password`) values ('Admin', 'admin')
 

