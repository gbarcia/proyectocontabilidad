SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `contabilidad` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `contabilidad`;

-- -----------------------------------------------------
-- Table `contabilidad`.`ASIENTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`ASIENTO` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`ASIENTO` (
  `num` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `fecha` DATE NOT NULL ,
  PRIMARY KEY (`num`) )
ENGINE = InnoDB
PACK_KEYS = DEFAULT;


-- -----------------------------------------------------
-- Table `contabilidad`.`CUENTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`CUENTA` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`CUENTA` (
  `num` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tipo` VARCHAR(1) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcion` VARCHAR(200) NULL ,
  PRIMARY KEY (`num`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contabilidad`.`CLIENTE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`CLIENTE` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`CLIENTE` (
  `rif` VARCHAR(20) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`rif`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contabilidad`.`PRODUCTO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`PRODUCTO` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`PRODUCTO` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `costo_unitario` FLOAT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contabilidad`.`VENTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`VENTA` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`VENTA` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `CLIENTE_rif` VARCHAR(20) NOT NULL ,
  `PRODUCTO_id` INT UNSIGNED NOT NULL ,
  `fecha` DATE NOT NULL ,
  `costo_unitario` FLOAT NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`, `CLIENTE_rif`, `PRODUCTO_id`) ,
  INDEX `fk_CLIENTE_has_PRODUCTO_CLIENTE` (`CLIENTE_rif` ASC) ,
  INDEX `fk_CLIENTE_has_PRODUCTO_PRODUCTO` (`PRODUCTO_id` ASC) ,
  CONSTRAINT `fk_CLIENTE_has_PRODUCTO_CLIENTE`
    FOREIGN KEY (`CLIENTE_rif` )
    REFERENCES `contabilidad`.`CLIENTE` (`rif` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CLIENTE_has_PRODUCTO_PRODUCTO`
    FOREIGN KEY (`PRODUCTO_id` )
    REFERENCES `contabilidad`.`PRODUCTO` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contabilidad`.`PROVEEDOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`PROVEEDOR` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`PROVEEDOR` (
  `rif` VARCHAR(20) NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`rif`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contabilidad`.`COMPRA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`COMPRA` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`COMPRA` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `PRODUCTO_id` INT UNSIGNED NOT NULL ,
  `PROVEEDOR_rif` VARCHAR(20) NOT NULL ,
  `fecha` DATE NOT NULL ,
  `costo_unitario` FLOAT NOT NULL ,
  `cantidad` INT UNSIGNED NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`, `PRODUCTO_id`, `PROVEEDOR_rif`) ,
  INDEX `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO` (`PRODUCTO_id` ASC) ,
  INDEX `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR` (`PROVEEDOR_rif` ASC) ,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PRODUCTO`
    FOREIGN KEY (`PRODUCTO_id` )
    REFERENCES `contabilidad`.`PRODUCTO` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PRODUCTO_has_PROVEEDOR_PROVEEDOR`
    FOREIGN KEY (`PROVEEDOR_rif` )
    REFERENCES `contabilidad`.`PROVEEDOR` (`rif` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `contabilidad`.`REGISTRO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contabilidad`.`REGISTRO` ;

CREATE  TABLE IF NOT EXISTS `contabilidad`.`REGISTRO` (
  `ASIENTO_num` INT UNSIGNED NOT NULL ,
  `CUENTA_num` INT UNSIGNED NOT NULL ,
  `debe` FLOAT NULL ,
  `haber` FLOAT NULL ,
  `VENTA_id` INT UNSIGNED NULL ,
  `VENTA_CLIENTE_rif` VARCHAR(20) NULL ,
  `VENTA_PRODUCTO_id` INT UNSIGNED NULL ,
  `COMPRA_id` INT UNSIGNED NULL ,
  `COMPRA_PRODUCTO_id` INT UNSIGNED NULL ,
  `COMPRA_PROVEEDOR_rif` VARCHAR(20) NULL ,
  `tipo` VARCHAR(1) NOT NULL ,
  PRIMARY KEY (`ASIENTO_num`, `CUENTA_num`) ,
  INDEX `fk_ASIENTO_has_CUENTA_ASIENTO` (`ASIENTO_num` ASC) ,
  INDEX `fk_ASIENTO_has_CUENTA_CUENTA` (`CUENTA_num` ASC) ,
  INDEX `fk_REGISTRO_VENTA` (`VENTA_id` ASC, `VENTA_CLIENTE_rif` ASC, `VENTA_PRODUCTO_id` ASC) ,
  INDEX `fk_REGISTRO_COMPRA` (`COMPRA_id` ASC, `COMPRA_PRODUCTO_id` ASC, `COMPRA_PROVEEDOR_rif` ASC) ,
  CONSTRAINT `fk_ASIENTO_has_CUENTA_ASIENTO`
    FOREIGN KEY (`ASIENTO_num` )
    REFERENCES `contabilidad`.`ASIENTO` (`num` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ASIENTO_has_CUENTA_CUENTA`
    FOREIGN KEY (`CUENTA_num` )
    REFERENCES `contabilidad`.`CUENTA` (`num` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REGISTRO_VENTA`
    FOREIGN KEY (`VENTA_id` , `VENTA_CLIENTE_rif` , `VENTA_PRODUCTO_id` )
    REFERENCES `contabilidad`.`VENTA` (`id` , `CLIENTE_rif` , `PRODUCTO_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_REGISTRO_COMPRA`
    FOREIGN KEY (`COMPRA_id` , `COMPRA_PRODUCTO_id` , `COMPRA_PROVEEDOR_rif` )
    REFERENCES `contabilidad`.`COMPRA` (`id` , `PRODUCTO_id` , `PROVEEDOR_rif` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
