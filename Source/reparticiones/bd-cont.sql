CREATE TABLE DEPARTAMENTO (
	id INT(10) NOT NULL auto_increment,
	nombre VARCHAR(100) NOT NULL,
	tipo VARCHAR(50) NOT NULL,
	area INT(5),
	valor_mye FLOAT (10,2),
	n_emp INT(5),
	materiales INT (10),
	kwh INT (10),
	hh_mob INT(5),
	CONSTRAINT pk_departamento PRIMARY KEY (id)
);

CREATE TABLE COSTO (
	id INT(10) NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(1000) NOT NULL,
	monto FLOAT(10,2),
	tipo_r VARCHAR(50),
	CONSTRAINT pk_costo PRIMARY KEY (id)
);

CREATE TABLE DEP_COST (
	id_departamento INT(10) NOT NULL,
	id_costo INT(10) NOT NULL,
	monto float (10,2)
);
