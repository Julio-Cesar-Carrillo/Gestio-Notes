DROP DATABASE db_ies_contreras;

CREATE DATABASE db_ies_contreras;

USE db_ies_contreras;

-- Crear la tabla de Estudiantes
CREATE TABLE tbl_alumnos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(100),
    pass VARCHAR(100),
    telefono VARCHAR(20)
);

-- Crear la tabla de Profesores
CREATE TABLE tbl_profesores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(100),
    pass VARCHAR(100)
);

-- Crear la tabla de Asignaturas
CREATE TABLE tbl_asignaturas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    id_profesor INT,
    FOREIGN KEY (id_profesor) REFERENCES tbl_profesores(id)
);

-- Crear la tabla de Notas
CREATE TABLE tbl_notas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_alumno INT,
    id_asignatura INT,
    nota DECIMAL(4, 2),
    fecha_registro DATE,
    FOREIGN KEY (id_alumno) REFERENCES tbl_alumnos(id),
    FOREIGN KEY (id_asignatura) REFERENCES tbl_asignaturas(id)
);

-- Crear la tabla de Administradores
CREATE TABLE tbl_administradores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100),
    pass VARCHAR(100)  -- Asegúrate de utilizar una técnica segura para almacenar contraseñas, como el hash de la contraseña.
);

-- Crear la tabla de Cursos
CREATE TABLE tbl_cursos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100)
);

-- Agregar una clave foránea en la tabla de Estudiantes para vincularlos a un curso
ALTER TABLE tbl_alumnos
ADD id_curso INT,
ADD FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id);

-- Agregar una clave foránea en la tabla de Profesores para vincularlos a un curso
ALTER TABLE tbl_profesores
ADD id_curso INT,
ADD FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id);

-- Agregar una clave foránea en la tabla de Asignaturas para vincularlas a un curso
ALTER TABLE tbl_asignaturas
ADD id_curso INT,
ADD FOREIGN KEY (id_curso) REFERENCES tbl_cursos(id);

-- Insert en tabla profesores
INSERT INTO
  `tbl_administradores` (`ID`, `email`, `pass`)
VALUES
  (
    NULL,
    'admin@gamil.com',
    '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225'
  );

-- Insert en la tabla profesores
INSERT INTO `tbl_profesores` (`id`, `nombre`, `apellido`,`email`,`pass`) VALUES (NULL, 'alberto','santos','alberto@fje.edu','15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225');
-- Insert en la tabla asignaturas
INSERT INTO `tbl_cursos` (`id`, `nombre`) VALUES (NULL, 'DAW');

-- Insert en la tabla asignaturas
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M12',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M7',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M6',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M9',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M8',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M3',1);
INSERT INTO `tbl_asignaturas` (`id`, `nombre`, `id_profesor`) VALUES (NULL, 'M2',1);
-- Insert en la tabla alumnos
INSERT INTO `tbl_alumnos` (`id`, `nombre`, `apellido`, `email`, `pass`, `telefono`, `id_curso`) VALUES (NULL, 'julio', 'carrillo', 'julio@gamil.com', 'asd', '123', '1');
