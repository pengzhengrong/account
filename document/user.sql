
CREATE SCHEMA `accountbook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
CREATE TABLE `accountbook`.`user` (
  `id` INT UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NULL,
  `loginname` VARCHAR(45) NULL,
  `passwd` VARCHAR(45) NULL,
  `createtime` DATE NULL,
  `age` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `loginname_UNIQUE` (`loginname` ASC),
  UNIQUE INDEX `passwd_UNIQUE` (`passwd` ASC))
AUTO_INCREMENT = 1
PACK_KEYS = DEFAULT;

ALTER TABLE `accountbook`.`user` 
CHANGE COLUMN `loginname` `loginname` VARCHAR(45) NULL DEFAULT NULL COMMENT '登入名' ;

ALTER TABLE `accountbook`.`user` 
CHANGE COLUMN `id` `id` INT(10) NOT NULL AUTO_INCREMENT ,
ADD UNIQUE INDEX `id_UNIQUE` (`id` ASC);
INSERT INTO `accountbook`.`user` (`id`, `name`, `loginname`, `passwd`, `createtime`, `age`) VALUES ('2', '2', '2', '2', now(), '2');


