/* todo-- MySQL Workbench Forward Engineering

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
-- ----------------------------------------------------- */

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

/* INSERT INTO todo (task_description, author, starting_date, end_date, status)
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
    ('Task 10', 'Author 10', '2023-10-13', '2023-10-19', 'pending'),
    ('Task 11', 'Author 11', '2023-10-09', '2023-10-10', 'pending'),
    ('Task 12', 'Author 12', '2023-10-10', '2023-10-11', 'ongoing'),
    ('Task 13', 'Author 13', '2023-10-11', '2023-10-12', 'completed'),
    ('Task 14', 'Author 14', '2023-10-12', '2023-10-13', 'pending'),
    ('Task 15', 'Author 15', '2023-10-13', '2023-10-14', 'ongoing'),
    ('Task 16', 'Author 16', '2023-10-14', '2023-10-15', 'completed'),
    ('Task 17', 'Author 17', '2023-10-15', '2023-10-16', 'pending'),
    ('Task 18', 'Author 18', '2023-10-16', '2023-10-17', 'ongoing'),
    ('Task 19', 'Author 19', '2023-10-17', '2023-10-18', 'completed'),
    ('Task 20', 'Author 20', '2023-10-18', '2023-10-19', 'pending'),
    ('Task 21', 'Author 21', '2023-10-04', '2023-10-10', 'pending'),
    ('Task 22', 'Author 22', '2023-10-05', '2023-10-11', 'ongoing'),
    ('Task 23', 'Author 23', '2023-10-06', '2023-10-12', 'completed'),
    ('Task 24', 'Author 24', '2023-10-07', '2023-10-13', 'pending'),
    ('Task 25', 'Author 25', '2023-10-08', '2023-10-14', 'ongoing'),
    ('Task 26', 'Author 26', '2023-10-09', '2023-10-15', 'completed'),
    ('Task 27', 'Author 27', '2023-10-10', '2023-10-16', 'pending'),
    ('Task 28', 'Author 28', '2023-10-11', '2023-10-17', 'ongoing'),
    ('Task 29', 'Author 29', '2023-10-12', '2023-10-18', 'completed'),
    ('Task 30', 'Author 30', '2023-10-13', '2023-10-19', 'pending'),
    ('Task 31', 'Author 31', '2023-10-04', '2023-10-10', 'pending'),
    ('Task 32', 'Author 32', '2023-10-05', '2023-10-11', 'ongoing'),
    ('Task 33', 'Author 33', '2023-10-06', '2023-10-12', 'completed'),
    ('Task 34', 'Author 34', '2023-10-07', '2023-10-13', 'pending'),
    ('Task 35', 'Author 35', '2023-10-08', '2023-10-14', 'ongoing'),
    ('Task 36', 'Author 36', '2023-10-09', '2023-10-15', 'completed'),
    ('Task 37', 'Author 37', '2023-10-10', '2023-10-16', 'pending'),
    ('Task 38', 'Author 38', '2023-10-11', '2023-10-17', 'ongoing'),
    ('Task 39', 'Author 39', '2023-10-12', '2023-10-18', 'completed'),
    ('Task 40', 'Author 40', '2023-10-13', '2023-10-19', 'pending'); 
    */