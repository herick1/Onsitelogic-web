<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTableAndStoresprocedured extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $sql = <<<SQL
            DROP PROCEDURE IF EXISTS sp_insert_participante;
            CREATE PROCEDURE sp_insert_participante(IN _cedula numeric(10) , IN _email varchar(200) , IN _pimer_nombre varchar(30), _segundo_nombre varchar(30), _primer_apellido varchar(60), _segundo_apellido varchar(60), _fecha_de_nacimiento date, _telefono varchar(30), _tipo varchar(20))
            BEGIN
                INSERT INTO `Participante`(`cedula`,  `email`, `pimer_nombre`,`segundo_nombre`,`primer_apellido`,`segundo_apellido`,`fecha_de_nacimiento`,`telefono`,`tipo`) VALUES(_cedula, _email, _pimer_nombre, _segundo_nombre, _primer_apellido, _segundo_apellido, _fecha_de_nacimiento, _telefono, _tipo);
            END;

            DROP PROCEDURE IF EXISTS sp_update_participante;
            CREATE PROCEDURE sp_update_participante(IN _id INT ,IN _cedula numeric(10) , IN _email varchar(200) , IN _pimer_nombre varchar(30), _segundo_nombre varchar(30), _primer_apellido varchar(60), _segundo_apellido varchar(60), _fecha_de_nacimiento date, _telefono varchar(30), _tipo varchar(20))
            BEGIN
                UPDATE `Participante` SET `email` = _email WHERE `id` = _id;
            END;

            DROP PROCEDURE IF EXISTS sp_delete_participante;
            CREATE PROCEDURE sp_delete_participante(IN _id INT)
            BEGIN
                delete from `Participante` WHERE `id` = _id;
            END
SQL;
// no se porque hay que dejar esta linea anterior alli asi porquue  si la trato de mover dar error al migrar 
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
        $sql = "DROP PROCEDURE IF EXISTS sp_insert_participante";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_update_participante";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_delete_participante";
        DB::connection()->getPdo()->exec($sql);

        Schema::drop('mensajes');
    }
}
