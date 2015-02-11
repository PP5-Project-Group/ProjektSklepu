CREATE TABLE User (
user_id int8 auto_increment,
login varchar(30) NOT NULL,
user_password varchar(60) NOT NULL,
mail varchar(30) NOT NULL,
telephon_number varchar(16) NOT NULL,
role int2 NOT NULL,
item_status int2,
PRIMARY KEY(user_id));


CREATE TABLE Category(
category_id INT8 auto_increment,
category varchar(20) NOT NULL,
PRIMARY KEY(category_id));


CREATE TABLE Movie (
movie_id int8 auto_increment,
title varchar(30) NOT NULL,
price decimal(9,2) NOT NULL,
description varchar(256) NOT NULL,
category_id int8,
img_url varchar(124),
actors varchar(124),
item_status int2,
PRIMARY KEY(movie_id),
FOREIGN KEY (category_id) references Category(category_id)

);

CREATE TABLE Review (
review_id int8 auto_increment,
movie_id int8 NOT NULL,
review_text varchar(512) NOT NULL,
user_id int8 NOT NULL,
rate int2,
PRIMARY KEY(review_id),
FOREIGN KEY(movie_id) references Movie (movie_id),
FOREIGN KEY(user_id) references User (user_id)
);

CREATE TABLE Morder (
order_id int8 auto_increment,
user_id int8 NOT NULL,
order_data date NOT NULL,
order_status int2 NOT NULL,
item_status int2,
PRIMARY KEY(order_id),
FOREIGN KEY (user_id) references User (user_id)
);

CREATE TABLE Morder_has_Movie (
morder_has_movie_id int8 auto_increment,
order_id int8 NOT NULL,
movie_id int8 NOT NULL,
PRIMARY KEY(morder_has_movie_id),
FOREIGN KEY (movie_id) references Movie (movie_id),
FOREIGN KEY (order_id) references Morder (order_id)
);