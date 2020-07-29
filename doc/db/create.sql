-- Magistrados 0.0

CREATE SCHEMA IF NOT EXISTS `magistrados` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;


CREATE TABLE IF NOT EXISTS `magistrados`.`departamento_judicial` (
  `id` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `magistrados`.`cargo` (
  `id` VARCHAR(45) NOT NULL,
  `descripción` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `magistrados`.`organo` (
  `id` VARCHAR(45) NOT NULL,
  `descripción` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `magistrados`.`tipo_documento` (
  `id` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `magistrados`.`persona` (
  `id` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(255) NULL DEFAULT NULL,
  `apellidos` VARCHAR(255) NULL DEFAULT NULL,
  `legajo` VARCHAR(45) NULL DEFAULT NULL,
  `numero_documento` VARCHAR(45) NOT NULL,
  `telefono_laboral` VARCHAR(255) NULL DEFAULT NULL,
  `telefono_particular` VARCHAR(255) NULL DEFAULT NULL,
  `fecha_nacimiento` DATE NULL DEFAULT NULL,
  `email` VARCHAR(255) NULL DEFAULT NULL,
  `creado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eliminado` TIMESTAMP NULL DEFAULT NULL,
  `cargo` VARCHAR(45) NOT NULL,
  `organo` VARCHAR(45) NOT NULL,
  `departamento_judicial` VARCHAR(45) NOT NULL,
  `departamento_judicial_informado` VARCHAR(45) NOT NULL,
  `tipo_documento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_persona_cargo_idx` (`cargo` ASC),
  INDEX `fk_persona_departamento_judicial_idx` (`departamento_judicial` ASC),
  INDEX `fk_persona_organo_idx` (`organo` ASC),
  INDEX `fk_persona_departamento_judicial_informado_idx` (`departamento_judicial_informado` ASC),
  INDEX `fk_persona_tipo_documento_idx` (`tipo_documento` ASC),
  CONSTRAINT `fk_persona_cargo`
    FOREIGN KEY (`cargo`)
    REFERENCES `magistrados`.`cargo` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_persona_departamento_judicial`
    FOREIGN KEY (`departamento_judicial`)
    REFERENCES `magistrados`.`departamento_judicial` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_persona_organo`
    FOREIGN KEY (`organo`)
    REFERENCES `magistrados`.`organo` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_persona_departamento_judicial_informado`
    FOREIGN KEY (`departamento_judicial_informado`)
    REFERENCES `magistrados`.`departamento_judicial` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_persona_tipo_documento`
    FOREIGN KEY (`tipo_documento`)
    REFERENCES `magistrados`.`tipo_documento` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `magistrados`.`afiliacion` (
  `id` VARCHAR(45) NOT NULL,
  `motivo` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `creado` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enviado` TIMESTAMP NULL DEFAULT NULL,
  `evaluado` TIMESTAMP NULL DEFAULT NULL,
  `modificado` TIMESTAMP NULL DEFAULT NULL,
  `observaciones` TEXT NULL DEFAULT NULL,
  `persona` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_afiliacion_persona_idx` (`persona` ASC),
  CONSTRAINT `fk_afiliacion_persona`
    FOREIGN KEY (`persona`)
    REFERENCES `magistrados`.`persona` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_spanish_ci;