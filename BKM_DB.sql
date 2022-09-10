
use projeto_integrador;

create table usuarios(
idUsuario int not null auto_increment,
nc_Usuario varchar(60),
email_Usuario varchar(50),
senha_Usuario varchar(12),
PRIMARY KEY (idUsuario)
);

