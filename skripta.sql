create database mkresonja_20_20 default character set utf8;

use mkresonja_20_20;

create table ontologija(
    sifra int not null primary key auto_increment,
    autor varchar(255),
    izdavac varchar(255),
    naslov varchar(255),
    zanr varchar(255),
    brojStranica int,
    jeIzdana int
);


drop table ontologija;

insert into ontologija(sifra, autor, izdavac, naslov, zanr, brojStranica, jeIzdana) values (1, "Autor", "Izdavac", "Naslov", "Zanr", 489, 2015);

select * from ontologija 

DELETE FROM ontologija
WHERE sifra = 1;