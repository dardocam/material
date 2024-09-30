# RELACIONES DE BASES DE DATOS SQL

## RELACION 1 a 1

- Este tipo de relación entre dos tablas se establece cuando un registro de una tabla solo puede estar vinculado a un único registro en otra tabla. 
- Este tipo de relación se utiliza generalmente para relaciones exclusivas cuando tenemos gran cantidad de campos. 
- Dicha relación nos permite dividir la información en tablas más pequeñas con menos cantidad de campos y facilitar la gestión de nuestras bases de datos.
- Dicha relación se establece a través de una Foreign Key que se vincula directamente con la Primary Key de la tabla principal. 
- En este tipo de relaciones será indistinto que tabla considerar principal y que tabla dependiente para establecer la Foreign Key, siendo ello decisión de diseño del administrador de acuerdo a los datos que guardar en las tablas.


[CONTINUE](https://sqlearning.com/es/introduccion-sql-server/tipo-relaciones/)


# RELACION 1 : N

    CREATE TABLE autores (
    id_autores INT PRIMARY KEY,
    nombre VARCHAR(255)
    );

    CREATE TABLE libros (
    id_libros INT PRIMARY KEY,
    titulo VARCHAR(255),
    fk_id_autores INT,
    FOREIGN KEY (fk_id_autores) REFERENCES autores(id_autores)
    );

# RELACION N : N

    CREATE TABLE estudiantes (
    id_estudiantes INT PRIMARY KEY,
    nombre VARCHAR(255)
    );

    CREATE TABLE cursos (
    id_cursos INT PRIMARY KEY,
    titulo VARCHAR(255)
    );

    CREATE TABLE inscripciones (
    id_inscripciones INT PRIMARY KEY,
    fk_id_estudiantes INT,
    fk_id_cursos INT,
    FOREIGN KEY (fk_id_estudiantes) REFERENCES estudiantes(id_estudiantes),
    FOREIGN KEY (fk_id_cursos) REFERENCES cursos(id_cursos)
    );