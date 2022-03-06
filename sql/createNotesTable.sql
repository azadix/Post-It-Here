CREATE TABLE IF NOT EXISTS `notes` (
    `id` INT(8) NOT NULL AUTO_INCREMENT,
    `isChecked` INT(1) NOT NULL,
    `content` TEXT(60) NOT NULL,
    `order` INT(8) NOT NULL,
    `containerId` INT(8) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;
