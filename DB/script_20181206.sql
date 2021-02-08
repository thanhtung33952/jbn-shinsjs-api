CREATE TABLE `shinsjs_dev`.`tb_user_temp` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL COMMENT 'email',
  `lastName` VARCHAR(45) NOT NULL COMMENT 'お名前（姓）',
  `firstName` VARCHAR(45) NOT NULL COMMENT 'お名前（名）',
  `spellingLastName` VARCHAR(45) NOT NULL COMMENT 'spellingLastName',
  `spellingFirstName` VARCHAR(45) NOT NULL COMMENT 'よみ（姓）',
  `password` VARCHAR(45) NOT NULL DEFAULT '',
  `status` INT(1) NOT NULL COMMENT '0: confirm, 1: success',
  PRIMARY KEY (`id`));
