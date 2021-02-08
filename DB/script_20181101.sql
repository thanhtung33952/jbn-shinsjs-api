--create table tb_tag
CREATE TABLE `tb_tag` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tagName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));

--create table tb_tag_details
CREATE TABLE `tb_tag_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idTag` VARCHAR(45) NOT NULL,
  `idArticle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `idTag`, `idArticle`));

--create table tb_article
CREATE TABLE `tb_article` (
  `id` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `createTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createBy` varchar(45) NOT NULL,
  PRIMARY KEY (`id`));

--create table tb_article_details
CREATE TABLE `tb_article_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articleId` VARCHAR(45) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `seq` INT NOT NULL,
  `val1` VARCHAR(45) NULL,
  `val2` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
  
--create table tb_history
 CREATE TABLE `tb_history` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `articleId` VARCHAR(45) NULL,
  `updateTime` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `updateBy` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));
