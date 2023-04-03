create table if not exists positions
(
    id    int unsigned auto_increment
        primary key,
    title varchar(15) not null
);

create table if not exists users
(
    id          int unsigned auto_increment
        primary key,
    name        varchar(45)  not null,
    last_name   varchar(45)  not null,
    position_id int unsigned null,
    constraint users_positions_id_fk
        foreign key (position_id) references test_task_web_dev.positions (id)
            on delete set null
);


INSERT INTO positions (title) VALUES ('manager');
INSERT INTO positions (title) VALUES ('developer');
INSERT INTO positions (title) VALUES ('tester');
