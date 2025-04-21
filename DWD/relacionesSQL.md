# RELACIONES y RESTRICCIONES DE INTEGRIDAD (CONSTRAINTS) EN BASES DE DATOS SQL

# - RELACIÓN 1 a 1

- Este tipo de relación entre dos tablas se establece cuando un registro de una tabla solo puede estar vinculado a un único registro en otra tabla y viceversa. 
- Este tipo de relación se utiliza generalmente para relaciones exclusivas cuando tenemos gran cantidad de campos. 
- Dicha relación nos permite dividir la información en tablas más pequeñas con menos cantidad de campos y facilitar la gestión de nuestras bases de datos.
- Dicha relación se establece a través de una Foreign Key tipo UNIQUE que se vincula directamente con la Primary Key de la tabla principal. 
- En este tipo de relaciones será indistinto que tabla considerar principal y que tabla dependiente para establecer la Foreign Key, siendo ello decisión de diseño del administrador de acuerdo a los datos que guardar en las tablas.
- Se utiliza cuando cada fila de ambas tablas está estrechamente relacionada con una sola fila de la otra tabla.
___
#### CREACIÓN DE TABLAS RELACIONADAS
    CREATE TABLE Empleado (
        id_empleado INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL
    );

    CREATE TABLE PerfilUsuario (
        id_perfil INT PRIMARY KEY AUTO_INCREMENT,
        fk_id_empleado INT UNIQUE NULL,
        direccion VARCHAR(255) NOT NULL,
        telefono VARCHAR(15) NOT NULL,
        CONSTRAINT fk_empleado_perfil FOREIGN KEY (fk_id_empleado) REFERENCES Empleado(id_empleado)
    );
___
#### EXPLICACIÓN

- La relación 1:1 está implementada mediante la columna id_empleado en la tabla PerfilUsuario, que es a la vez clave foránea y **única** (UNIQUE), garantizando que cada empleado tenga como máximo un perfil de usuario asociado.
- Cardinalidad: Un Empleado tiene un solo perfil, y un PerfilUsuario está asociado a un solo empleado.
- Para cada registro en PerfilUsuario, puede haber uno o ningún empleado asociado.
- Si un perfil de usuario tiene el campo id_empleado como NULL, significa que ese perfil no está asociado con ningún empleado en la tabla Empleado.
- Si el campo id_empleado tiene un valor, entonces ese perfil pertenece a exactamente un empleado.
___
#### EJEMPLO DE INSERCIÓN
    INSERT INTO Empleado (nombre, email) VALUES ('Juan Pérez', 'juan@example.com');
    INSERT INTO PerfilUsuario (fk_id_empleado, direccion, telefono) VALUES (1, 'Calle 123', '555-1234');
___
#### DIAGRAMA DE ENTIDAD RELACIÓN

| Empleado              |    
|-----------------------|
| id_empleado: *INT*    |   
| nombre: *VARCHAR(100)*| 
| email: *VARCHAR(100)* | 
|                       |
        Ŧ
        |0..1
        |
        |
        |
    0..1|
        ^
| PerfilUsuario |    
|----------|
| id_perfil: *INT* | 
| fk_id_empleado: *INT* |   
| direccion: *VARCHAR(255)* | 
| telefono: *VARCHAR(15)* | 
|                         | 
___
#### CARDINALIDAD
- Empleado tiene un "0..1" en el lado de PerfilUsuario (es decir, puede tener 0 o 1 perfil).
- PerfilUsuario tiene un "0..1" en el lado de Empleado (debe estar asociado a exactamente un empleado o puede no estar asociado si es NULL).
- Para cada registro en Empleado, puede haber cero o uno en PerfilUsuario.
- Para cada registro en PerfilUsuario, puede haber uno o ningún empleado asociado.
___


# - RELACIÓN 1 : N

- Este tipo de relación entre dos tablas se establece cuando un registro de una tabla puede estar vinculado a N registros en otra tabla pero no viceversa.
___
#### CREACIÓN DE TABLAS RELACIONADAS
    CREATE TABLE Autores (
        id_autores INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(255)
    );

    CREATE TABLE Libros (
        id_libros INT PRIMARY KEY AUTO_INCREMENT,
        titulo VARCHAR(255),
        fk_id_autores INT NOT NULL,
        CONSTRAINT fk_autores_libros FOREIGN KEY (fk_id_autores) REFERENCES Autores(id_autores)
    );
___
#### EXPLICACIÓN

- La relación 1:N está implementada mediante la columna *id_autores* en la tabla **Libros**, que es a la vez clave foránea, garantizando que cada libro tenga un autor y cada autor tenga como máximo **N** libros asociados.
- Cardinalidad: Un Autor tiene muchos Libros, y un Libro está asociado a un solo Autor.

___
#### EJEMPLO DE INSERCIÓN
    INSERT INTO Autores (nombre) VALUES ('Pedro Bonifacio Palacios alias Almafuerte');
    INSERT INTO Libros (fk_id_autores, titulo) VALUES (1, 'Poema Piú Avanti');
    INSERT INTO Libros (fk_id_autores, titulo) VALUES (1, 'Poesias Completas (1917)');
    INSERT INTO Libros (fk_id_autores, titulo) VALUES (1, 'Siete sonetos medicinales (1907)');
___
#### EJEMPLO DE CONSULTAS COMPLEJAS
- Selecionar todos los libros del autor "Almafuerte" incluyendo su nombre en el resultado.
___

    SELECT Autores.nombre, Libros.titulo 
    FROM Libros 
    INNER JOIN Autores ON Autores.id_autores = Libros.fk_id_autores 
    WHERE Autores.nombre LIKE '%Almafuerte';

___
#### DIAGRAMA DE ENTIDAD RELACIÓN

| Autores              |    
|-----------------------|
| id_autores: *INT*    |   
| nombre: *VARCHAR(255)*| 
|                       |
        Ŧ
        |1..1
        |
        |
        |
    1..N|
        ^
| Libros |    
|----------|
| id_libros: *INT* | 
| fk_id_autores: *INT* |   
| titulo: *VARCHAR(255)* | 
|                         | 
___
#### CARDINALIDAD
- Autor tiene un "1..N" en el lado de Libros (es decir, puede tener 1 o N libros).
- Libros tiene un "1..1" en el lado de Autores (es decir, el libro debe estar asociado a exactamente un solo autor y este no puede ser NULL).
- Cuando se inserta un libro se debe introducir el autor obligatoriamente.


___


# - RELACIÓN N : N

- En una relación N : N, un registro en una tabla puede estar relacionado con muchos registros en otra tabla y viceversa.
- Para implementar una relación N : N, necesitamos una tabla intermedia que actúe como enlace entre las dos tablas principales.
    #### EJEMPLO
    - Un estudiante puede estar inscrito en muchos cursos, y un curso puede tener muchos estudiantes inscritos.
    - **Estudiante**: Almacena información de los estudiantes.
    - **Curso**: Almacena los cursos disponibles.
    - **EstudianteCurso**: Es la tabla intermedia que almacena las relaciones entre estudiantes y cursos.

___

    CREATE TABLE Estudiante (
        id_estudiante INT PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL
    );

    CREATE TABLE Curso (
        id_curso INT PRIMARY KEY AUTO_INCREMENT,
        nombre_curso VARCHAR(100) NOT NULL
    );

    CREATE TABLE EstudianteCurso (
        fk_id_estudiante INT,
        fk_id_curso INT,
        fecha_inscripcion DATE NOT NULL,
        CONSTRAINT fk_estudiante_curso FOREIGN KEY (fk_id_estudiante) REFERENCES Estudiante(id_estudiante),
        CONSTRAINT fk_curso_estudiante FOREIGN KEY (fk_id_curso) REFERENCES Curso(id_curso),
        PRIMARY KEY (fk_id_estudiante, fk_id_curso)
    );

___
#### EXPLICACIÓN

- La tabla EstudianteCurso es la tabla intermedia que vincula estudiantes con cursos.
- *fk_id_estudiante* y *fk_id_curso* son claves foráneas que referencian a las tablas **Estudiante** y **Curso** respectivamente.
- La combinación de ambas columnas fk_id_estudiante y fk_id_curso forma la clave primaria compuesta, lo que garantiza que un estudiante puede estar inscrito en un curso una sola vez.
**Cardinalidad**: Un **Estudiante** puede estar en muchos cursos, y un **Curso** puede tener muchos estudiantes.

___
#### EJEMPLO DE INSERCIÓN
    INSERT INTO Estudiante (nombre) VALUES ('Ana Gómez');
    INSERT INTO Curso (nombre_curso) VALUES ('Matemáticas'), ('Historia');

    -- Ana se inscribe en dos cursos
    INSERT INTO EstudianteCurso (id_estudiante, id_curso, fecha_inscripcion) VALUES (1, 1, '2023-09-01');
    INSERT INTO EstudianteCurso (id_estudiante, id_curso, fecha_inscripcion) VALUES (1, 2, '2023-09-02');

___

# RESUMEN de CARDINALIDADES
- **1 : 1 (Uno a uno)**: Un registro de la tabla A está relacionado con un solo registro de la tabla B, y viceversa.
- **1 : N (Uno a muchos)**: Un registro de la tabla A puede estar relacionado con muchos registros de la tabla B, pero un registro de la tabla B está relacionado con un solo registro de la tabla A.
- **N : N (Muchos a muchos)**: Un registro de la tabla A puede estar relacionado con muchos registros de la tabla B, y viceversa, implementado con una tabla intermedia.
___

