
use projeto_integrador;
drop table if exists usuarios;
create table usuarios(
id int not null auto_increment,
nc_Usuario varchar(60),
email varchar(50),
senha varchar (12),
primary key(id)
)engine=InnoDB auto_increment=5 default charset=utf8mb3;

lock table usuarios write;
insert into usuarios values
(1,'kelvin','kelvin@silva.com','111'),(2,'alvin','alvi@gomes.com','2222');
unlock tables;
select*from usuarios;
