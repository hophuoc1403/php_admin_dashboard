create database shopping default character set utf8 collate utf8_unicode_ci;
use shopping;

create table if not exists category
(
    id     int not null auto_increment,
    name   varchar(255),
    status tinyint default 1,
    primary key (id)
);

create table if not exists product
(
    id          int not null auto_increment,
    name        varchar(255),
    price       float,
    sale_price  float   default 0,
    image       varchar(255),
    description text,
    status      tinyint default 1,
    category_id int not null,
    primary key (id)
);

create table if not exists users
(
    id       int not null auto_increment,
    name     varchar(255),
    email    varchar(255) unique,
    password varchar(255),
    phone    varchar(11) unique,
    role     tinyint default 0,
    status   tinyint default 1,
    primary key (id)
);

create table if not exists orders
(
    id      int  not null auto_increment,
    user_id int  not null,
    address text not null,
    phone   varchar(11),
    note    text,
    status  tinyint default 0,
    primary key (id)
);

create table if not exists order_detail
(
    order_id   int  not null,
    product_id int  not null,
    address    text not null,
    quantity   int  not null,
    price      float
);

alter table product
    add foreign key (category_id) references category (id);
alter table orders
    add foreign key (user_id) references users (id);
alter table order_detail
    add foreign key (order_id) references orders(id);
alter table  order_detail add  foreign key (product_id) references product(id);


