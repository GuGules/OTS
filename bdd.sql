drop database ots;
create database if not exists ots;
use ots;

create table message(
    id char(56) primary key unique,
    pass_hash varchar(64),
    message text not null,
    time_stamp timestamp default current_timestamp
);

create table lang(
    lang_id int primary key auto_increment,
    lang_lib varchar(255),
    flag_url varchar(255)
);

create table lang_key(
    id int primary key auto_increment,
    lang_id int,
    flag varchar(100),
    wwwText text,
    foreign key (lang_id) references lang(lang_id)
);

insert into lang(lang_lib,flag_url) values ('Français','fr.svg'),('English','en.svg');
