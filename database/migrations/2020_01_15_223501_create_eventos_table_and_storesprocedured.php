<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTableAndStoresprocedured extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
            DROP PROCEDURE IF EXISTS sp_insert_evento;
            CREATE PROCEDURE sp_insert_evento( IN _tipo varchar(20) , IN _nombre varchar(60), _cantidad_de_personas numeric(5), _fecha_inicio date, _fecha_fin date, IN _lugar int )
            BEGIN
                INSERT INTO `Evento`(`tipo`,  `nombre`, `cantidad_de_personas`,`fecha_inicio`,`fecha_fin`, `fk_lugar` ) VALUES(_tipo, _nombre, _cantidad_de_personas, _fecha_inicio, _fecha_fin);
            END;

            DROP PROCEDURE IF EXISTS sp_update_evento;
            CREATE PROCEDURE sp_update_evento(IN _id INT ,IN _tipo varchar(20) , IN _nombre varchar(60), _cantidad_de_personas numeric(5), _fecha_inicio date, _fecha_fin date, IN _lugar int )
            BEGIN
                UPDATE `Evento` SET `tipo` = _tipo, `nombre` = _nombre, `cantidad_de_personas` = _cantidad_de_personas,   `fecha_inicio` = _fecha_inicio, `fecha_fin` = _fecha_fin, `fk_lugar` = _lugar
                WHERE `id` = _id;
            END;

            DROP PROCEDURE IF EXISTS sp_delete_evento;
            CREATE PROCEDURE sp_delete_evento(IN _id INT)
            BEGIN
                delete from `Evento` WHERE `id` = _id;
            END
SQL;
        DB::connection()->getPdo()->exec($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //eliminando los procedimientos almacenados
        $sql = "DROP PROCEDURE IF EXISTS sp_insert_evento";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_update_evento";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_delete_evento";
        DB::connection()->getPdo()->exec($sql);

   
    }
}
