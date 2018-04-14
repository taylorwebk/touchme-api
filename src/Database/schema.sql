-- ESTUDIANTE, APODERADO, DOCENTE, REGENTE
-- ADMINISTRADOR, MATERIA, CURSO, TRABAJO, BIMESTRE
/*
apoderado: tabla para almacenar a los apoderados de los
estudiantes inscritos
*/
drop database if exists touchmedb;
CREATE DATABASE touchmedb DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
use touchmedb;
create table jugador(
  id integer not null auto_increment,
  nombres varchar(255),
  correo varchar(127),
  primary key(id)
);
create table record(
  id integer not null auto_increment,
  jugador_id integer not null,
  score integer,
  primary key(id),
  foreign key(jugador_id)
  references jugador(id)
  on delete cascade
);
