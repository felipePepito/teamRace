SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `teamrace` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `teamrace` ;

-- -----------------------------------------------------
-- Table `teamrace`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`user` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `first_name` VARCHAR(255) NOT NULL ,
  `last_name` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `active` INT NOT NULL COMMENT '0: inactive, 1: active' ,
  `account_created` DATETIME NOT NULL ,
  `password_requested_at` DATETIME NULL ,
  `confirmation_token` VARCHAR(255) NULL ,
  `last_login` DATETIME NULL ,
  `image` VARCHAR(255) NULL COMMENT 'relative path to image' ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id_user`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`teamraces`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`teamraces` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`teamraces` (
  `id_teamrace` INT NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `id_creator` INT NOT NULL ,
  `description` TEXT NULL ,
  `dateCreated` DATETIME NOT NULL ,
  `image` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_teamrace`) ,
  INDEX `fk_teamrace_1_idx` (`id_creator` ASC) ,
  CONSTRAINT `fk_teamrace_1`
    FOREIGN KEY (`id_creator` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`messages` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`messages` (
  `id_message` INT NOT NULL AUTO_INCREMENT ,
  `id_sender` INT NOT NULL ,
  `id_recipient` INT NOT NULL ,
  `text` TEXT NOT NULL ,
  `date` DATETIME NOT NULL ,
  PRIMARY KEY (`id_message`) ,
  INDEX `fk_messages_1_idx` (`id_sender` ASC) ,
  INDEX `fk_messages_2_idx` (`id_recipient` ASC) ,
  CONSTRAINT `fk_messages_1`
    FOREIGN KEY (`id_sender` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_2`
    FOREIGN KEY (`id_recipient` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`user_teamrace`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`user_teamrace` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`user_teamrace` (
  `id_user_teamrace` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `id_teamrace` INT NOT NULL ,
  `role` INT NOT NULL ,
  INDEX `fk_user_teamrace_1_idx` (`id_user` ASC) ,
  INDEX `fk_user_teamrace_2_idx` (`id_teamrace` ASC) ,
  PRIMARY KEY (`id_user_teamrace`) ,
  CONSTRAINT `fk_user_teamrace_1`
    FOREIGN KEY (`id_user` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_teamrace_2`
    FOREIGN KEY (`id_teamrace` )
    REFERENCES `teamrace`.`teamraces` (`id_teamrace` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`challenges`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`challenges` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`challenges` (
  `id_challenge` INT NOT NULL ,
  `type` INT NOT NULL ,
  PRIMARY KEY (`id_challenge`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`teams`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`teams` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`teams` (
  `id_team` INT NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `image` VARCHAR(255) NULL ,
  `slogan` VARCHAR(2048) NULL ,
  `id_teamrace` INT NOT NULL ,
  PRIMARY KEY (`id_team`) ,
  INDEX `fk_teams_1_idx` (`id_teamrace` ASC) ,
  CONSTRAINT `fk_teams_1`
    FOREIGN KEY (`id_teamrace` )
    REFERENCES `teamrace`.`teamraces` (`id_teamrace` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`teamrace_challenge`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`teamrace_challenge` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`teamrace_challenge` (
  `id_teamrace_challenge` INT NOT NULL ,
  `id_teamrace` INT NOT NULL ,
  `id_challenge` INT NOT NULL ,
  `date` DATETIME NULL ,
  `max_points` DOUBLE NULL ,
  `description` TEXT NULL ,
  `id_tutor` INT NULL ,
  PRIMARY KEY (`id_teamrace_challenge`) ,
  INDEX `fk_teamrace_challenge_1_idx` (`id_teamrace` ASC) ,
  INDEX `fk_teamrace_challenge_2_idx` (`id_challenge` ASC) ,
  INDEX `fk_teamrace_challenge_3_idx` (`id_tutor` ASC) ,
  CONSTRAINT `fk_teamrace_challenge_1`
    FOREIGN KEY (`id_teamrace` )
    REFERENCES `teamrace`.`teamraces` (`id_teamrace` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teamrace_challenge_2`
    FOREIGN KEY (`id_challenge` )
    REFERENCES `teamrace`.`challenges` (`id_challenge` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teamrace_challenge_3`
    FOREIGN KEY (`id_tutor` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`challenge_team`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`challenge_team` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`challenge_team` (
  `id_challenge_team` INT NOT NULL ,
  `id_challenge` INT NOT NULL ,
  `id_team` INT NOT NULL ,
  `points` DOUBLE NULL ,
  INDEX `fk_challenge_team_1_idx` (`id_challenge` ASC) ,
  INDEX `fk_challenge_team_2_idx` (`id_team` ASC) ,
  PRIMARY KEY (`id_challenge_team`) ,
  CONSTRAINT `fk_challenge_team_1`
    FOREIGN KEY (`id_challenge` )
    REFERENCES `teamrace`.`challenges` (`id_challenge` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_challenge_team_2`
    FOREIGN KEY (`id_team` )
    REFERENCES `teamrace`.`teams` (`id_team` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`blogs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`blogs` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`blogs` (
  `id_blog` INT NOT NULL ,
  `headline` VARCHAR(255) NOT NULL ,
  `text` TEXT NOT NULL ,
  `id_teamrace` INT NOT NULL ,
  PRIMARY KEY (`id_blog`) ,
  INDEX `fk_blogs_1_idx` (`id_teamrace` ASC) ,
  CONSTRAINT `fk_blogs_1`
    FOREIGN KEY (`id_teamrace` )
    REFERENCES `teamrace`.`teamraces` (`id_teamrace` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teamrace`.`user_team`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `teamrace`.`user_team` ;

CREATE  TABLE IF NOT EXISTS `teamrace`.`user_team` (
  `id_user_team` INT NOT NULL ,
  `id_user` INT NOT NULL ,
  `id_team` INT NOT NULL ,
  `role` INT NOT NULL ,
  PRIMARY KEY (`id_user_team`) ,
  INDEX `fk_user_team_1_idx` (`id_user` ASC) ,
  INDEX `fk_user_team_2_idx` (`id_team` ASC) ,
  CONSTRAINT `fk_user_team_1`
    FOREIGN KEY (`id_user` )
    REFERENCES `teamrace`.`user` (`id_user` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_team_2`
    FOREIGN KEY (`id_team` )
    REFERENCES `teamrace`.`teams` (`id_team` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
