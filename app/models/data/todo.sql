-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE SCHEMA IF NOT EXISTS `todo` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema todo
-- -----------------------------------------------------
USE `todo` ;

-- -----------------------------------------------------
-- Table `mydb`.`todo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `todo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `task_description` VARCHAR(45) NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `starting_date` DATE NULL,
  `end_date` DATE NULL,
  `status` ENUM('pending', 'ongoing', 'completed') NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO todo (task_description, author, starting_date, end_date, status)
VALUES
    ('Task 1', 'Author 1', '2023-10-04', '2023-10-10', 'pending'),
    ('Task 2', 'Author 2', '2023-10-05', '2023-10-11', 'ongoing'),
    ('Task 3', 'Author 3', '2023-10-06', '2023-10-12', 'completed'),
    ('Task 4', 'Author 4', '2023-10-07', '2023-10-13', 'pending'),
    ('Task 5', 'Author 5', '2023-10-08', '2023-10-14', 'ongoing'),
    ('Task 6', 'Author 6', '2023-10-09', '2023-10-15', 'completed'),
    ('Task 7', 'Author 7', '2023-10-10', '2023-10-16', 'pending'),
    ('Task 8', 'Author 8', '2023-10-11', '2023-10-17', 'ongoing'),
    ('Task 9', 'Author 9', '2023-10-12', '2023-10-18', 'completed'),
    ('Task 10', 'Author 10', '2023-10-13', '2023-10-19', 'pending');

select * from todo;