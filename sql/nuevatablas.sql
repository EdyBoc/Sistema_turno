    CREATE TABLE persona (
    id_persona INT PRIMARY KEY AUTO_INCREMENT,
    cui VARCHAR(36) NOT NULL UNIQUE,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    fh_nacimiento DATE NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    sexo CHAR(1) NOT NULL,
    nit VARCHAR(20) NOT NULL,
    departamento VARCHAR(255) NOT NULL,
    pais VARCHAR(255) NOT NULL,
    fh_contratado DATE NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15)
    );

 CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    cui VARCHAR(15) UNIQUE,
    estado TINYINT(1) DEFAULT true,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );


    CREATE TABLE password_resets (
        email VARCHAR(255),
        token VARCHAR(255),
        created_at TIMESTAMP NULL
    );

    CREATE INDEX email_index ON password_resets (email);

    --Esta tabla es funcional para accesso
    CREATE TABLE personal_access_tokens (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        tokenable_id BIGINT UNSIGNED,
        tokenable_type VARCHAR(255),
        name VARCHAR(255),
        token VARCHAR(64) UNIQUE,
        abilities TEXT,
        last_used_at TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )


    CREATE TABLE roles (
    id_roles INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo_rol INT NOT NULL,
    id_usuario INT NOT NULL,
    id_persona INT,
    fh_asignacion DATETIME NOT NULL,
    estado BOOLEAN ,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    FOREIGN KEY (id_catalogo_rol) REFERENCES catalogo_rol(id_catalogo_rol),
    FOREIGN KEY (id_persona) REFERENCES persona(id_persona),
    FOREIGN KEY (id_usuario) REFERENCES users(id)
    );


    CREATE TABLE solicitud (
        id_solicitud INT PRIMARY KEY AUTO_INCREMENT,
        id_usuario INT NOT NULL,
        tipo_solicitud VARCHAR(25) NOT NULL,
        fecha_solicitud DATETIME NOT NULL,
        obervacion VARCHAR(255) NOT NULL,
        estado BOOLEAN,
        user varchar(191),
        fn_ingreso datetime ,
        fn_ultima_modificacion datetime ,
        ip VARCHAR(15) ,
        FOREIGN KEY (id_usuario) REFERENCES users(id)
    );

    CREATE TABLE reporte_horas (
        id_reporte_horas INT PRIMARY KEY AUTO_INCREMENT,
        id_usuario INT NOT NULL,
        inicio_hora TIME NOT NULL,
        fin_hora TIME NOT NULL,
        fecha_reporte_horas DATETIME NOT NULL,
        estado BOOLEAN,
        user varchar(191),
        fn_ingreso datetime ,
        fn_ultima_modificacion datetime ,
        ip VARCHAR(15) ,
        FOREIGN KEY (id_usuario) REFERENCES users(id)
    );


    CREATE TABLE codigo_ingreso (
        id_codigo_ingreso INT PRIMARY KEY AUTO_INCREMENT,
        id_usuario INT NOT NULL,
        codigo INT NOT NULL,
        estado BOOLEAN,
        user varchar(191),
        fn_ingreso datetime ,
        fn_ultima_modificacion datetime ,
        ip VARCHAR(15) ,
        FOREIGN KEY (id_usuario) REFERENCES users(id)
    );


     CREATE OR REPLACE VIEW vw_usuarios AS
    SELECT
        pers.id,
        pers.name,
        pers.email,
        pers.cui,
        rol.id_catalogo_rol,
        cr.nombre AS nombre_rol,
        rol.estado
    FROM
        users pers
    LEFT JOIN
        roles rol ON pers.id = rol.id_usuario
    LEFT JOIN
        catalogo_rol cr ON rol.id_catalogo_rol = cr.id_catalogo_rol;