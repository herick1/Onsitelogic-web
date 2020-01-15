<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesInsert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<SQL
                create table Lugar(
                  id integer unique,
                  nombre varchar(40) not null,
                  tipo varchar(30) not null,
                  fk_Lugar integer,
                  constraint pk_idLugar primary key(id),
                  constraint fk_Lugar_id FOREIGN KEY (fk_Lugar) REFERENCES Lugar (id)
                );

                create table Participante(
                   id integer unique AUTO_INCREMENT,
                   cedula numeric(10),
                   email varchar(200),
                   pimer_nombre varchar(30),
                   segundo_nombre varchar(30),
                   primer_apellido varchar(60),
                   segundo_apellido varchar(60),
                   fecha_de_nacimiento date,
                   telefono varchar(30),
                   tipo varchar(20),
                   fk_lugar integer,
                   constraint pk_idUsuario primary key(id),
                   constraint fk_parlugar foreign key(fk_lugar) references Lugar(id),
                   constraint CK_tipo check(tipo in('Visitante','Exponente','Asesor', 'Otros'))
                );

                create table Evento(
                   id integer unique AUTO_INCREMENT,
                   tipo varchar(20),
                   nombre varchar(60),
                   cantidad_de_personas numeric(5),
                   fecha_inicio date,
                   fecha_fin date,
                   fk_lugar integer,
                   constraint pk_idEvento primary key(id),
                   constraint fk_Evenlugar foreign key(fk_lugar) references Lugar(id)
                );

                create table Historial_Usuario_Evento(
                   id integer,
                   asistencia int NOT NULL,
                  fecha_inicio date,
                   fecha_fin date,
                   fk_participante integer,
                   fk_evento integer,
                   constraint pk_id_historial primary key(id),
                   constraint fk_particiHistorial foreign key(fk_participante) references Participante(id),
                   constraint fk_eventHistorial foreign key(fk_evento) references Evento(id),
                   constraint CK_boo_asistencia CHECK (asistencia IN (0, 1))
                );
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
        $sql = <<<SQL
            drop table Historial_Usuario_Evento;
            drop table Participante;
            drop table Evento;
            drop table Lugar;
SQL;
// no se porque hay que dejar esta linea anterior alli asi porquue  si la trato de mover dar error al migrar 
        DB::connection()->getPdo()->exec($sql);
    }
}
