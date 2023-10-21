use blog;

CREATE table user(
    id int AUTO_INCREMENT,
    username VARCHAR(50) not null UNIQUE,
    email VARCHAR(40) not null UNIQUE,
    password VARCHAR(32) not null,
    avatar VARCHAR(255),
    PRIMARY KEY(id)
);  