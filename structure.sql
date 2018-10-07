create table basket_item
(
  ID        int auto_increment primary key,
  productID int not null,
  guestID   int not null,
  orderID   int not null,
  quantity  int not null
);

create table product
(
  ID          int auto_increment primary key,
  name        varchar(256)   not null,
  priceNetto  decimal(18, 2) not null,
  priceBrutto decimal(18, 2) not null,
  imagePath   varchar(256)   not null,
  color       varchar(16)    not null
);

create table user
(
  ID       int auto_increment primary key,
  password varchar(256) not null,
  name     varchar(256) not null,
  email    varchar(64)  not null,
  constraint user_email_uindex
  unique (email)
);

create table guest
(
  ID int auto_increment primary key
);

CREATE TABLE order_item
(
    ID int PRIMARY KEY AUTO_INCREMENT,
    deliveryID int NOT NULL,
    paymentID int NOT NULL,
    userID int NOT NULL,
    comment varchar(1024)
);