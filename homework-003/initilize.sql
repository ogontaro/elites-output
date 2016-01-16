create database nowall_login2;

use nowall_login2;

grant all on nowall_login2.* to testuser@localhost identified by '9999';

create table users (
id int primary key auto_increment,
name varchar(32),
hashed_password varchar(255),
created_at datetime
);