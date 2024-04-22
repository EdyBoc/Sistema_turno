  CREATE TABLE Vacacion (
    id_vacacion INT PRIMARY KEY AUTO_INCREMENT,
    id_persona INT NOT NULL,
    periodo_vacacion INT NOT NULL,
    fn_inicio DATE NOT NULL,
    fn_fin DATE NOT NULL,
    dias_gozados INT NOT NULL,
    dias_rezagados INT NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    FOREIGN KEY (id_persona) REFERENCES Persona(id_persona)
    );
