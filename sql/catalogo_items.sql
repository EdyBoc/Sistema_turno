
CREATE TABLE catalogo_items (
    id_catalogo_item INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    fh_control DATETIME NOT NULL,
    fn_ingreso datetime ,
    user varchar(191),
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    CONSTRAINT FK_catalogo_items_catalgo FOREIGN KEY (id_catalogo) REFERENCES catalogo(id_catalogo)
    );
    


INSERT INTO catalogo_items (id_catalogo, nombre, descripcion, estado, fh_control, fn_ingreso, user, fn_ultima_modificacion, ip)
VALUES (1, 'Nombre de prueba', 'Descripción de prueba', true, NOW(), NOW(), 'UsuarioPrueba', NOW(), '192.168.1.1');