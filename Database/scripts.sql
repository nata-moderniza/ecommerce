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

ALTER TABLE product ADD COLUMN path_imagem text;

CREATE TABLE order (
  id_order serial PRIMARY KEY,
  id_user int not null,
  name_user varchar(200),
  street varchar(500),
  zipcode varchar(9),
  situation varchar(2)
    CONSTRAINT fk_user
      FOREIGN KEY(id_user) 
	  REFERENCES users(id)
);

CREATE TABLE order_item (
  id_order_item serial PRIMARY KEY,
  id_product int not null,
  quantity integer,
  price_unit numeric(15,2),
  price_total numeric(15,2),
 CONSTRAINT fk_product
  FOREIGN KEY(id_product) 
	  REFERENCES product(id_product)
);
