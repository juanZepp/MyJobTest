create database IF NOT EXISTS MyJob;

use MyJob;

#drop database  MyJob;

create table  IF NOT EXISTS students(
email varchar(50) not null,
password varchar(50),
privilegios varchar(30) default 'student',
studentId int not null auto_increment ,
careerId int not null,
dni int not null,
firstName varchar(30) not null,
lastName varchar(30) not null,
fileNumber int not null,
phoneNumber int not null,
gender varchar(30) not null,
birthday varchar(30) not null,
active varchar(30) not null,
primary key (studentId),
primary key (dni),
constraint uniq_email unique (email),
constraint uniq_dni unique (dni)
);
#drop table  students;

