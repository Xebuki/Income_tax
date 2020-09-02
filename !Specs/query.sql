CREATE DATABASE podatki;
USE podatki;

ALTER DATABASE podatki CHARACTER SET utf8 COLLATE utf8_polish_ci;
ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE utf8_polish_ci; 

CREATE TABLE uzytkownicy(
PESEL varchar(11) primary key,
password varchar(50) not null
);

CREATE TABLE dane_podstawowe(
imie char(25) not null,
nazwisko char(30) not null,
PESEL varchar(11) not null,
NIP bigint(10) not null
);

CREATE TABLE dane_podatkowe(
podstawa varchar(50) not null,
PESEL varchar(11) not null,
rok_obrachunkowy int(4) not null,
przychod int(50) not null,
dochod int(50) not null,
koszt_przychodu int(50) not null,
skladki_zdrowotne int(50) not null,
podatek int(50) not null
);



Alter Table dane_podstawowe
add FOREIGN KEY (PESEL) REFERENCES uzytkownicy(PESEL);

Alter Table dane_podatkowe
add FOREIGN KEY (PESEL) REFERENCES dane_podstawowe(PESEL);

INSERT INTO uzytkownicy (PESEL, password) 
VALUES ('Admin', 'root');