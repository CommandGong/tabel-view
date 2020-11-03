CREATE TABLE `work` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `doi` VARCHAR(125) NULL UNIQUE,
  `publisher` VARCHAR(255) NULL, 
  `create_date` DATETIME NULL,
  `type` VARCHAR(125) NULL,
  `title` VARCHAR(125) NULL,
  `container-title` VARCHAR(125) NULL,
  `issn` VARCHAR(125) NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `work` 
ADD COLUMN `author` JSON NULL AFTER `issn`; 

 