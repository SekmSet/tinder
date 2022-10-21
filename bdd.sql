create table users
(
    id             int auto_increment
        primary key,
    firstName      varchar(100) null,
    lastName       varchar(100) null,
    gender         varchar(10)  null,
    created_date   date         not null,
    city           varchar(100) not null,
    country        varchar(100) not null,
    bio            varchar(255) null,
    last_connexion date         not null,
    birth_date     date         not null,
    looking        varchar(100) null,
    distance       int          null,
    username       varchar(100) not null,
    password       varchar(100) not null,
    email          varchar(255) not null,
    updated_date   date         not null,
    min_age        int          null,
    max_age        int          null,
    status         tinyint(1)   not null,
    constraint email
        unique (email),
    constraint username
        unique (username)
);

create table images
(
    id           int auto_increment
        primary key,
    user_id      int          not null,
    url          varchar(255) not null,
    created_date date         not null,
    `order`      int          not null,
    constraint images_users_fk
        foreign key (user_id) references users (id)
);

create table `match`
(
    id          int auto_increment
        primary key,
    action      varchar(100) not null comment 'unlike, super like or like',
    first_user  int          not null comment 'user id who send the match in first',
    second_user int          not null comment 'user id who send the match in second',
    constraint match_users_first_fk
        foreign key (first_user) references users (id),
    constraint match_users_second_fk
        foreign key (second_user) references users (id)
);

create table messages
(
    id          int auto_increment
        primary key,
    id_sender   int          not null comment 'user how send in first the message to an another user',
    id_receiver int          not null,
    message     varchar(255) not null,
    send_at     date         not null,
    read_at     time         null,
    constraint messages_receiver_id_fk
        foreign key (id_receiver) references users (id),
    constraint messages_sender_id_fk
        foreign key (id_sender) references users (id)
);

create database tinder;