CREATE TABLE users (
  id serial PRIMARY KEY,
  email varchar (120),
  name varchar (120),
  password text,
  role varchar(40),
  is_deleted BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE provider (
  id_provider serial PRIMARY KEY,
  name varchar (120) not null,
  description varchar (200),
  phone varchar(20),
  email varchar(80),
  is_deleted BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE product (
  id_product serial PRIMARY KEY,
  name varchar (120) not null,
  description varchar (200),
  is_deleted BOOLEAN NOT NULL DEFAULT FALSE,
  id_provider int not null,
    CONSTRAINT fk_provider
      FOREIGN KEY(id_provider) 
	  REFERENCES provider(id_provider)
);

CREATE TABLE product_stock (
 id_product_stock serial PRIMARY KEY,
 id_product int not null,
 quantity integer,
 price numeric(15,2),
 CONSTRAINT fk_product
  FOREIGN KEY(id_product) 
	  REFERENCES product(id_product)
);

insert into users (email, name, password, role) values ('admin@admin.com', 'Natã Giertyas',
'82b83e666a49d8a95c424330bb4edfc8', 'admin')

ALTER TABLE product ADD COLUMN path_imagem text
