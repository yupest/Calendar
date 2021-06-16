CREATE TABLE `types` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `types` (`name`) VALUES
('встреча'), 
('звонок'), 
('совещание'), 
('дело');

CREATE TABLE `tasks` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `type_id` INT(10) UNSIGNED NOT NULL,  
  `place` VARCHAR(255),
  `date` DATE NOT NULL, 
  `time` TIME NOT NULL,   
  `duration` VARCHAR(255) NOT NULL,   
  `comment` VARCHAR(255), 
  `status` ENUM ('current','failed','completed') NOT NULL DEFAULT 'current',
  `deleted_at` TIMESTAMP,
  PRIMARY KEY(`id`)
);