/* autoincrement table provincias*/

ALTER TABLE `provincias` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;





ALTER TABLE `legis_conectadas`.`provincias` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD COLUMN `habitantes` VARCHAR(45) NULL AFTER `fecha_upd`,
ADD COLUMN `superficie` VARCHAR(45) NULL AFTER `habitantes`;



/*agrego campo id_pais a la provincia / region  */

ALTER TABLE `provincias` ADD `id_pais` INT(11) NOT NULL AFTER `zona`;
/*agrego campo latitud/longitud  a la provincia / region  */
ALTER TABLE `provincias` ADD `latitud` VARCHAR(255) NOT NULL AFTER `superficie`, ADD `longitud` VARCHAR(255) NOT NULL AFTER `latitud`;

/* actualizo todas las provincias actuales con id pais 3 (Argentina) */
UPDATE `provincias` SET `id_pais`= 3 WHERE id_pais = ''


/* Barra navegacion backend subir */

views/manager/etiquetas/nav.php


/* carpeta vistas paises  crear y copiar carpeta */

views/manager/secciones/paises/

/* Controller paises pegar Paises.php */


application/controllers/Manager/Paises.php

/* Modelo de datos paises pegar Paises.php */
application/models/Manager/Paises_model.php
application/models/Manager/Pais_model.php


/*carpeta static/manager/scripts/paises */
/*carpeta static/web/images/paises/flags */