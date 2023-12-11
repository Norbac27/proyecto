CREATE TABLE pais (
    id_pais VARCHAR(10) PRIMARY KEY,
    nombre_pais VARCHAR(50)
);

CREATE TABLE departamento_Region (
    id_departamento VARCHAR(10) PRIMARY KEY,
    nombre_departamento VARCHAR(50),
    id_pais VARCHAR(10),
    FOREIGN KEY (id_pais) REFERENCES pais(id_pais)
);

CREATE TABLE ciudad (
    id_ciudad VARCHAR(10) PRIMARY KEY,
    nombre_ciudad VARCHAR(50),
    id_departamento VARCHAR(10),
    FOREIGN KEY (id_departamento) REFERENCES departamento_Region(id_departamento)
);

CREATE TABLE direccion (
    id_direccion VARCHAR(10) PRIMARY KEY,
    id_ciudad VARCHAR(10),
    calle VARCHAR(20),
    numero INT,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id_ciudad)
);

CREATE TABLE nivelriesgo (
    id_nivel_riesgo VARCHAR(10) PRIMARY KEY,
    nombre_nivel_riesgo VARCHAR(50),
    tasa_cotizacion DECIMAL(5, 2)
);

CREATE TABLE arl (
    id_arl VARCHAR(10) PRIMARY KEY,
    nombre_arl VARCHAR(50),
    clase_riesgo VARCHAR(10),
    FOREIGN KEY (clase_riesgo) REFERENCES nivelriesgo(id_nivel_riesgo)
);

CREATE TABLE banco (
    id_banco VARCHAR(10) PRIMARY KEY,
    nombre_banco VARCHAR(50),
    codigo_banco VARCHAR(10) UNIQUE
);

CREATE TABLE naturaleza_juridica (
    id_naturaleza_juridica VARCHAR(10) PRIMARY KEY,
    nombre_naturaleza_juridica VARCHAR(50)
);

CREATE TABLE empresa (
    nit_empresa VARCHAR(10) PRIMARY KEY,
    nombre_empresa VARCHAR(50),
    id_naturaleza_juridica VARCHAR(10),
    seguridad_social DECIMAL(10, 2),
    id_direccion VARCHAR(10),
    FOREIGN KEY (id_naturaleza_juridica) REFERENCES naturaleza_juridica(id_naturaleza_juridica),
    FOREIGN KEY (id_direccion) REFERENCES direccion(id_direccion)
);

CREATE TABLE parafiscales (
    id_parafiscal VARCHAR(10) PRIMARY KEY,
    nit_empresa VARCHAR(10),
    aporte_icbf DECIMAL(5, 2),
    aporte_sena DECIMAL(5, 2),
    aporte_cajas_compensacion DECIMAL(5, 2),
    FOREIGN KEY (nit_empresa) REFERENCES empresa(nit_empresa)
);

CREATE TABLE departamento (
    id_departamento VARCHAR(10) PRIMARY KEY,
    nombre_departamento VARCHAR(50),
    nit_empresa VARCHAR(10),
    FOREIGN KEY (nit_empresa) REFERENCES empresa(nit_empresa)
);

CREATE TABLE cargo (
    id_cargo VARCHAR(10) PRIMARY KEY,
    nombre_cargo VARCHAR(50),
    id_departamento VARCHAR(10),
    id_nivel_riesgo VARCHAR(10),
    FOREIGN KEY (id_departamento) REFERENCES departamento(id_departamento),
    FOREIGN KEY (id_nivel_riesgo) REFERENCES nivelriesgo(id_nivel_riesgo)
);

CREATE TABLE tipoempleado (
    id_tipo_empleado VARCHAR(10) PRIMARY KEY,
    nombre_tipo_empleado VARCHAR(50)
);

CREATE TABLE tiponovedad (
    id_tipo_novedad VARCHAR(10) PRIMARY KEY,
    nombre_tipo_novedad VARCHAR(50)
);

CREATE TABLE empleado (
    nro_documento VARCHAR(10) PRIMARY KEY,
	tipo_documento VARCHAR(3),
	fecha_nacimiento_empleado DATE,
    nombre1_empleado VARCHAR(20),
	nombre2_empleado VARCHAR(20),
	apellido1_empleado VARCHAR(20),
	apellido2_empleado VARCHAR(20),
    nit_empresa VARCHAR(10),
    id_tipo_empleado VARCHAR(10),
    id_cargo VARCHAR(10),
    fecha_contratacion DATE,
    salario DECIMAL(10, 2),
    id_direccion VARCHAR(10),
    fotocopia_documento VARCHAR(255),
    FOREIGN KEY (nit_empresa) REFERENCES empresa(nit_empresa),
    FOREIGN KEY (id_tipo_empleado) REFERENCES tipoempleado(id_tipo_empleado),
    FOREIGN KEY (id_cargo) REFERENCES cargo(id_cargo),
    FOREIGN KEY (id_direccion) REFERENCES direccion(id_direccion)
);

CREATE TABLE novedad (
    id_novedad VARCHAR(10) PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    id_tipo_novedad VARCHAR(10),
    descripcion VARCHAR(100),
    fecha_novedad DATE,
    cantidad_horas DECIMAL(5, 2),
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento),
    FOREIGN KEY (id_tipo_novedad) REFERENCES tiponovedad(id_tipo_novedad)
);

CREATE TABLE pagodevengado (
    id_pago_devengado VARCHAR(10) PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    tipo_pago VARCHAR(50),
    monto DECIMAL(10, 2),
    fecha_pago DATE,
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento)
);

CREATE TABLE seguridadesocial (
    id_seguridad_social VARCHAR(10) PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    nombre_seguridad_social VARCHAR(50),
    porcentaje_empleado DECIMAL(5, 2),
    porcentaje_empleador DECIMAL(5, 2),
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento)
);

CREATE TABLE familiar (
    nro_documento_familiar VARCHAR(10)PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    tipo_documento VARCHAR(3),
    nombre1_familiar VARCHAR(30),
	nombre2_familiar VARCHAR(30),
	apellido1_familiar VARCHAR(30),
	apellido2_familiar VARCHAR(30),
    parentesco VARCHAR(20),
    fecha_nacimiento DATE,
    fotocopia_documento VARCHAR(255),
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento)
);

CREATE TABLE prestaciones (
    id_prestacion VARCHAR(10) PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    tipo_prestacion VARCHAR(50),
    monto DECIMAL(10, 2),
    fecha_pago DATE,
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento)
);

CREATE TABLE cuentabancaria (
    id_cuenta_bancaria VARCHAR(10) PRIMARY KEY,
    nro_documento_empleado VARCHAR(10),
    id_banco VARCHAR(10),
    numero_cuenta VARCHAR(20),
    tipo_cuenta VARCHAR(20),
    certificado_bancario VARCHAR(255),
    FOREIGN KEY (nro_documento_empleado) REFERENCES empleado(nro_documento),
    FOREIGN KEY (id_banco) REFERENCES banco(id_banco)
);

-- Inserciones para la tabla pais
INSERT INTO pais (id_pais, nombre_pais) VALUES
('1', 'Colombia'),
('2', 'Argentina'),
('3', 'Brasil'),
('4', 'Chile'),
('5', 'México');

-- Inserciones para la tabla departamento_Region
INSERT INTO departamento_Region (id_departamento, nombre_departamento, id_pais) VALUES
('1', 'Antioquia', '1'),
('2', 'Buenos Aires', '2'),
('3', 'Sao Paulo', '3'),
('4', 'Santiago', '4'),
('5', 'Ciudad de México', '5');

-- Inserciones para la tabla ciudad
INSERT INTO ciudad (id_ciudad, nombre_ciudad, id_departamento) VALUES
('1', 'Medellín', '1'),
('2', 'Buenos Aires', '2'),
('3', 'Sao Paulo', '3'),
('4', 'Santiago de Chile', '4'),
('5', 'Ciudad de México', '5');

-- Inserciones para la tabla direccion
INSERT INTO direccion (id_direccion, id_ciudad, calle, numero) VALUES
('1', '1', 'Calle 1', 123),
('2', '2', 'Avenida 2', 456),
('3', '3', 'Rua 3', 789),
('4', '4', 'Avenida 4', 1011),
('5', '5', 'Calle 5', 1213);

-- Inserciones para la tabla nivelriesgo
INSERT INTO nivelriesgo (id_nivel_riesgo, nombre_nivel_riesgo, tasa_cotizacion) VALUES
('1', 'Bajo', 0.5),
('2', 'Medio', 1.0),
('3', 'Alto', 2.0),
('4', 'Muy Alto', 3.0),
('5', 'Extremo', 5.0);

-- Inserciones para la tabla arl
INSERT INTO arl (id_arl, nombre_arl, clase_riesgo) VALUES
('1', 'ARL Seguros S.A.', '1'),
('2', 'ARL Proteger S.A.', '2'),
('3', 'ARL Riesgos Laborales S.A.', '3'),
('4', 'ARL Integral S.A.', '4'),
('5', 'ARL Total S.A.', '5');

-- Inserciones para la tabla banco
INSERT INTO banco (id_banco, nombre_banco, codigo_banco) VALUES
('1', 'Banco A', '001'),
('2', 'Banco B', '002'),
('3', 'Banco C', '003'),
('4', 'Banco D', '004'),
('5', 'Banco E', '005');

-- Inserciones para la tabla naturaleza_juridica
INSERT INTO naturaleza_juridica (id_naturaleza_juridica, nombre_naturaleza_juridica) VALUES
('1', 'Sociedad Anónima'),
('2', 'Sociedad Limitada'),
('3', 'Sociedad de Responsabilidad Limitada'),
('4', 'Sociedad por Acciones Simplificada'),
('5', 'Empresa Unipersonal');

-- Inserciones para la tabla empresa
INSERT INTO empresa (nit_empresa, nombre_empresa, id_naturaleza_juridica, seguridad_social, id_direccion) VALUES
('1234567890', 'Empresa A', '1', 1500.00, '1'),
('9876543210', 'Empresa B', '2', 2000.00, '2'),
('1112223334', 'Empresa C', '3', 2500.00, '3'),
('4445556667', 'Empresa D', '4', 3000.00, '4'),
('7778889990', 'Empresa E', '5', 3500.00, '5');

-- Inserciones para la tabla parafiscales
INSERT INTO parafiscales (id_parafiscal, nit_empresa, aporte_icbf, aporte_sena, aporte_cajas_compensacion) VALUES
('1', '1234567890', 100.00, 150.00, 200.00),
('2', '9876543210', 120.00, 130.00, 180.00),
('3', '1112223334', 80.00, 110.00, 160.00),
('4', '4445556667', 90.00, 140.00, 220.00),
('5', '7778889990', 110.00, 170.00, 250.00);

-- Inserciones para la tabla departamento
INSERT INTO departamento (id_departamento, nombre_departamento, nit_empresa) VALUES
('1', 'Departamento A', '1234567890'),
('2', 'Departamento B', '9876543210'),
('3', 'Departamento C', '1112223334'),
('4', 'Departamento D', '4445556667'),
('5', 'Departamento E', '7778889990');

-- Inserciones para la tabla cargo
INSERT INTO cargo (id_cargo, nombre_cargo, id_departamento, id_nivel_riesgo) VALUES
('1', 'Gerente', '1', '5'),
('2', 'Analista', '2', '3'),
('3', 'Programador', '3', '2'),
('4', 'Contador', '4', '4'),
('5', 'Asistente Administrativo', '5', '1');

-- Inserciones para la tabla tipoempleado
INSERT INTO tipoempleado (id_tipo_empleado, nombre_tipo_empleado) VALUES
('1', 'Tiempo Completo'),
('2', 'Medio Tiempo'),
('3', 'Por Horas'),
('4', 'Prácticas'),
('5', 'Contratista');

-- Inserciones para la tabla tiponovedad
INSERT INTO tiponovedad (id_tipo_novedad, nombre_tipo_novedad) VALUES
('1', 'Incapacidad'),
('2', 'Vacaciones'),
('3', 'Licencia No Remunerada'),
('4', 'Bono'),
('5', 'Otro');

-- Inserciones para la tabla empleado
INSERT INTO empleado (nro_documento, tipo_documento, fecha_nacimiento_empleado, nombre1_empleado, nombre2_empleado, apellido1_empleado, apellido2_empleado, nit_empresa, id_tipo_empleado, id_cargo, fecha_contratacion, salario, id_direccion, fotocopia_documento) VALUES
('1234567890', 'CC', '1990-01-15', 'Juan', 'Pablo', 'Gomez', 'Lopez', '1234567890', '1', '1', '2022-01-01', 5000.00, '1', '/ruta/fotocopia_juan.pdf'),
('9876543210', 'CC', '1985-08-22', 'Ana', 'Maria', 'Rodriguez', 'Vega', '9876543210', '2', '2', '2022-02-15', 3500.00, '2', '/ruta/fotocopia_ana.pdf'),
('1112223334', 'CC', '1993-05-10', 'Carlos', 'Andres', 'Perez', 'Garcia', '1112223334', '3', '3', '2022-03-20', 2800.00, '3', '/ruta/fotocopia_carlos.pdf'),
('4445556667', 'CC', '1988-11-30', 'Laura', 'Isabel', 'Diaz', 'Martinez', '4445556667', '4', '4', '2022-04-10', 4000.00, '4', '/ruta/fotocopia_laura.pdf'),
('7778889990', 'CC', '1995-04-05', 'Diego', 'Alejandro', 'Sanchez', 'Lopez', '7778889990', '5', '5', '2022-05-05', 3200.00, '5', '/ruta/fotocopia_diego.pdf');

-- Inserciones para la tabla novedad
INSERT INTO novedad (id_novedad, nro_documento_empleado, id_tipo_novedad, descripcion, fecha_novedad, cantidad_horas) VALUES
('1', '1234567890', '1', 'Incapacidad por enfermedad', '2022-01-15', 8.0),
('2', '9876543210', '2', 'Vacaciones anuales', '2022-02-20', 16.0),
('3', '1112223334', '3', 'Licencia no remunerada', '2022-03-25', 24.0),
('4', '4445556667', '4', 'Bono por desempeño', '2022-04-15', 2.0),
('5', '7778889990', '5', 'Novedad personalizada', '2022-05-20', 10.0);

-- Inserciones para la tabla pagodevengado
INSERT INTO pagodevengado (id_pago_devengado, nro_documento_empleado, tipo_pago, monto, fecha_pago) VALUES
('1', '1234567890', 'Salario Mensual', 5000.00, '2022-01-31'),
('2', '9876543210', 'Salario Mensual', 3500.00, '2022-02-28'),
('3', '1112223334', 'Salario Mensual', 2800.00, '2022-03-31'),
('4', '4445556667', 'Salario Mensual', 4000.00, '2022-04-30'),
('5', '7778889990', 'Salario Mensual', 3200.00, '2022-05-31');

-- Inserciones para la tabla seguridadesocial
INSERT INTO seguridadesocial (id_seguridad_social, nro_documento_empleado, nombre_seguridad_social, porcentaje_empleado, porcentaje_empleador) VALUES
('1', '1234567890', 'Salud', 4.0, 8.0),
('2', '9876543210', 'Pensión', 3.5, 7.0),
('3', '1112223334', 'ARP', 1.0, 2.0),
('4', '4445556667', 'Cesantías', 2.0, 4.0),
('5', '7778889990', 'Caja de Compensación', 1.5, 3.0);

-- Inserciones para la tabla familiar
INSERT INTO familiar (nro_documento_familiar, nro_documento_empleado, tipo_documento, nombre1_familiar, nombre2_familiar, apellido1_familiar, apellido2_familiar, parentesco, fecha_nacimiento, fotocopia_documento) VALUES
('1111111111', '1234567890', 'CC', 'María', '', 'Gomez', 'Lopez', 'Hija', '2010-03-12', '/ruta/fotocopia_maria.pdf'),
('2222222222', '9876543210', 'CC', 'Pedro', 'Andres', 'Rodriguez', 'Vega', 'Hijo', '2015-08-18', '/ruta/fotocopia_pedro.pdf'),
('3333333333', '1112223334', 'CC', 'Sofia', 'Isabel', 'Perez', 'Garcia', 'Hija', '2018-05-05', '/ruta/fotocopia_sofia.pdf'),
('4444444444', '4445556667', 'CC', 'Mateo', 'Alejandro', 'Diaz', 'Martinez', 'Hijo', '2013-10-22', '/ruta/fotocopia_mateo.pdf'),
('5555555555', '7778889990', 'CC', 'Camila', 'Fernanda', 'Sanchez', 'Lopez', 'Hija', '2016-04-30', '/ruta/fotocopia_camila.pdf');

-- Inserciones para la tabla prestaciones
INSERT INTO prestaciones (id_prestacion, nro_documento_empleado, tipo_prestacion, monto, fecha_pago) VALUES
('1', '1234567890', 'Prima de Servicios', 400.00, '2022-06-30'),
('2', '9876543210', 'Cesantías', 700.00, '2022-06-30'),
('3', '1112223334', 'Vacaciones', 560.00, '2022-07-15'),
('4', '4445556667', 'Prima de Servicios', 800.00, '2022-06-30'),
('5', '7778889990', 'Cesantías', 640.00, '2022-06-30');

-- Inserciones para la tabla cuentabancaria
INSERT INTO cuentabancaria (id_cuenta_bancaria, nro_documento_empleado, id_banco, numero_cuenta, tipo_cuenta, certificado_bancario) VALUES
('1', '1234567890', '1', '12345678901234567890', 'Ahorros', '/ruta/certificado_juan.pdf'),
('2', '9876543210', '2', '98765432109876543210', 'Corriente', '/ruta/certificado_ana.pdf'),
('3', '1112223334', '3', '11122233344455566677', 'Ahorros', '/ruta/certificado_carlos.pdf'),
('4', '4445556667', '4', '44455566677788899900', 'Corriente', '/ruta/certificado_laura.pdf'),
('5', '7778889990', '5', '77788899900011122233', 'Ahorros', '/ruta/certificado_diego.pdf');
