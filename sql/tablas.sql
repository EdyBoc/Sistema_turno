CREATE TABLE asignacion_turno (
    id_asignacion_turno INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo_items INT NOT NULL,
    id_usuario INT NOT NULL,
    fh_asignacion_dependencia DATETIME NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    CONSTRAINT FK_asignacion_turno_catalogo_items FOREIGN KEY (id_catalogo_items) REFERENCES catalogo_items(id_catalogo_item),
    CONSTRAINT FK_asignacion_turno_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    );


    CREATE TABLE control_ingreso_salida (
    id_control INT PRIMARY KEY AUTO_INCREMENT,
    fh_hora_ingreso DATETIME NOT NULL,
    fh_hora_salida DATETIME NOT NULL,
    id_usuario INT NOT NULL,
    fh_control DATE NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    CONSTRAINT FK_control_ingreso_salida_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    );


    CREATE TABLE asignacion_dependencia (
    id_asignacion_dependencia INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo_items INT NOT NULL,
    fh_asignacion_dependencia DATE NOT NULL,
    id_usuario INT NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    CONSTRAINT FK_asignacion_dependencia_catalogo_items FOREIGN KEY (id_catalogo_items) REFERENCES catalogo_items(id_catalogo_item),
    CONSTRAINT FK_asignacion_dependencia_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    );

--Esta tabla es funcional
    CREATE TABLE Persona (
    id_persona INT PRIMARY KEY AUTO_INCREMENT,
    cui VARCHAR(36) NOT NULL UNIQUE,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    fh_nacimiento DATE NOT NULL,
    fh_contratado DATE NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15)
    );

--Esta tabla es funcional
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



--Esta tabla es funcional
    CREATE TABLE catalogo (
        id_catalogo INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(255) NOT NULL,
        fh_catalogo DATETIME NOT NULL,
        user varchar(191),
        fn_ingreso datetime ,
        fn_ultima_modificacion datetime ,
        ip VARCHAR(15)
    );


--Esta tabla es funcional
    CREATE TABLE catalogo_items (
    id_catalogo_item INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    fh_catalogo_items DATETIME NOT NULL,
    fn_ingreso datetime ,
    user varchar(191),
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    CONSTRAINT FK_catalogo_items_catalgo FOREIGN KEY (id_catalogo) REFERENCES catalogo(id_catalogo)
    );



--Esta tabla es funcional

    CREATE TABLE catalogo_rol (
    id_catalogo_rol INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    fn_catalogo_rol DATE NOT NULL,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15)
    );

--Esta tabla es funcional

    CREATE TABLE roles (
    id_roles INT PRIMARY KEY AUTO_INCREMENT,
    id_catalogo_rol INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha_control DATETIME NOT NULL,
    estado BOOLEAN NOT NULL DEFAULT true,
    user varchar(191),
    fn_ingreso datetime ,
    fn_ultima_modificacion datetime ,
    ip VARCHAR(15) ,
    FOREIGN KEY (id_catalogo_rol) REFERENCES catalogo_rol(id_catalogo_rol),
    FOREIGN KEY (id_usuario) REFERENCES users(id)
    );

--Esta tabla es funcional
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



    --Esta tabla es funcional para receteo de correo electronico
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

    ---Esta vista ya es funcional usa tabla users, roles , catalogo roles
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
