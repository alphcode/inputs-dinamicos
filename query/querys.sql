create database contacto;
use contacto;

create table contacto_general
(
    coal_id_contacto_general int auto_increment
        primary key,
    coal_nombre_contacto     varchar(60) null,
    coal_numero              varchar(60) null
);

create table contacto_nombre
(
    coes_id_contacto_nombres int auto_increment
        primary key,
    coes_nombre              varchar(100) null,
    coes_id_contacto_general int          null,
    constraint contacto_nombre_contacto_general_coal_id_contacto_general_fk
        foreign key (coes_id_contacto_general) references contacto_general (coal_id_contacto_general)
);