CREATE TABLE Persona (
    id_persona INT PRIMARY KEY AUTO_INCREMENT,
    cui VARCHAR(36) NOT NULL UNIQUE,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    fh_nacimiento DATE NOT NULL,
    fh_contratado DATE NOT NULL,
    departamento VARCHAR(100),
    ciudad VARCHAR(100),
    codigo_postal VARCHAR(10),
    nacionalidad VARCHAR(100),
    direccion VARCHAR(255),
    estado_civil VARCHAR (10),
    estado INT NOT NULL,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) 
    );


    -- Ejemplo de inserción de datos
INSERT INTO Persona (cui, nombre_completo, telefono, correo_electronico, fh_nacimiento, fh_contratado, departamento, ciudad, codigo_postal, nacionalidad, direccion, estado_civil, estado, user, fn_ingreso, fn_ultima_modificacion, ip)
VALUES ('1234567890123456789012345678901234', 'Juan Pérez', '1234567890', 'juan@example.com', '1990-05-15', '2020-01-01', 'Administración', 'Ciudad de México', '12345', 'Mexicana', 'Calle 123', 'Soltero', 1, 'admin', NOW(), NOW(), '192.168.1.1');

-- Otro ejemplo de inserción de datos
INSERT INTO Persona (cui, nombre_completo, telefono, correo_electronico, fh_nacimiento, fh_contratado, departamento, ciudad, codigo_postal, nacionalidad, direccion, estado_civil, estado, user, fn_ingreso, fn_ultima_modificacion, ip)
VALUES ('0987654321098765432109876543210987', 'María García', '0987654321', 'maria@example.com', '1985-10-20', '2018-06-15', 'Recursos Humanos', 'Guadalajara', '54321', 'Mexicana', 'Avenida 456', 'Casado', 1, 'admin', NOW(), NOW(), '192.168.1.2');