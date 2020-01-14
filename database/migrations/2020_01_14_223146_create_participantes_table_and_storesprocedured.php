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
        Schema::create('mensajes', function ( $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->text('mensaje');
            $table->timestamps();
        });
        $sql = <<<SQL
            DROP PROCEDURE IF EXISTS sp_insert_mensajes;
            CREATE PROCEDURE sp_insert_mensajes(IN _name VARCHAR(32) , IN _email VARCHAR(32) , IN _mensaje VARCHAR(32))
            BEGIN
                INSERT INTO `mensajes`(`nombre`,`email`,`mensaje`) VALUES(_name, _email, _mensaje);
            END;

            DROP PROCEDURE IF EXISTS sp_update_mensajes;
            CREATE PROCEDURE sp_update_mensajes(IN _id INT ,IN _mensaje VARCHAR(32))
            BEGIN
                UPDATE `mensajes` SET `mensaje` = _mensaje WHERE `id` = _id;
            END;

            DROP PROCEDURE IF EXISTS sp_delete_mensajes;
            CREATE PROCEDURE sp_delete_mensajes(IN _id INT)
            BEGIN
                delete from `mensajes` WHERE `id` = _id;
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
        $sql = "DROP PROCEDURE IF EXISTS sp_insert_mensajes";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_update_mensajes";
        DB::connection()->getPdo()->exec($sql);

        $sql = "DROP PROCEDURE IF EXISTS sp_delete_mensajes";
        DB::connection()->getPdo()->exec($sql);

        Schema::drop('mensajes');
    }
}
