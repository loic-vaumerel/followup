drop table if exists followup.action_category;
drop table if exists followup.category;
drop table if exists followup.action;
drop table if exists followup.type_category;
drop table if exists followup.type_action;
drop table if exists followup.person;
drop table if exists followup.user;

create table followup.user (
  id bigint not null auto_increment,
  name text not null,
  email text not null,
  password text not null,
  active bool not null,
  constraint user_pk primary key (id),
  constraint user_uk_name unique (name)
);

create table followup.person (
  id bigint not null auto_increment,
  name text not null,
  constraint person_pk primary key (id),
  constraint person_uk_name unique (name)
);

create table followup.type_action (
  id bigint not null auto_increment,
  giver_id bigint,
  name varchar (250) not null,
  receiver_id bigint,
  constraint type_action_pk primary key (id),
  constraint type_action_uk_giver_name_receiver unique (giver_id, name, receiver_id),
  constraint type_action_fk_giver_id    foreign key (giver_id)    references followup.person (id),
  constraint type_action_fk_receiver_id foreign key (receiver_id) references followup.person (id)
);

create table followup.type_category (
  id bigint not null auto_increment,
  person_id bigint not null,
  name text not null,
  constraint type_category_pk primary key (id),
  constraint type_category_uk_name unique (name),
  constraint type_category_fk_person_id foreign key (person_id) references followup.person (id)
);

create table followup.action (
  id bigint not null auto_increment,
  date datetime not null,
  type_action_id bigint not null,
  quantity bigint,
  unit text,
  constraint action_pk primary key (id),
  constraint action_fk_type_action_id foreign key (type_action_id) references type_action (id)
);

create table followup.action_category (
  id bigint not null auto_increment,
  action_id bigint not null,
  type_category_id bigint not null,
  constraint action_category_pk primary key (id),
  constraint action_category_fk_action_id foreign key (action_id) references action (id),
  constraint action_category_fk_type_category_id foreign key (type_category_id) references type_category (id)
);

insert into followup.user values (null, 'user1', 'user&@email.com', 'NOT_INITIALIZED', false);

insert into followup.person values (null, 'bob');
insert into followup.person values (null, 'alice');

insert into followup.type_action select null, 1, 'is doing A to', 2;

insert into followup.type_category values (null, 1, ' category 1');

insert into followup.action values (null, now () - interval 30 minute, 1, 100, 'times');

select * from information_schema.tables where table_schema = 'followup';
select * from information_schema.table_constraints where table_schema = 'followup' or constraint_schema = 'followup';

select * from followup.user;
select * from followup.person;
select * from followup.type_action;
select * from followup.type_category;
select * from followup.action;
-- select * from followup.event;


/*drop table if exists followup.data_event;
drop table if exists followup.type_action;
drop table if exists followup.type_constraint;
drop table if exists followup.type_event;
drop table if exists followup.type_object;
drop table if exists followup.type_position;
drop table if exists followup.user;

create table if not exists followup.user (
  id bigint not null auto_increment,
  name text not null,
  email text not null,
  password text not null,
  active bool not null,
  constraint user_pk primary key (id),
  constraint user_uk_name unique (name)
);

create table if not exists followup.type_action (
  id bigint not null auto_increment,
  name text not null,
  number bigint not null,
  constraint type_action_pk primary key (id)
);

create table if not exists followup.type_event (
  id bigint not null auto_increment,
  name text not null,
  constraint type_event_pk primary key (id)
);

create table if not exists followup.type_object (
  id bigint not null auto_increment,
  name text not null,
  constraint type_object_pk primary key (id)
);

create table if not exists followup.type_position (
  id bigint not null auto_increment,
  name text not null,
  constraint type_position_pk primary key (id)
);

create table if not exists followup.type_constraint (
  id bigint not null auto_increment,
  name text not null,
  constraint type_constraint_pk primary key (id)
);

create table if not exists followup.data_event (
  id bigint not null auto_increment,
  type_event_id bigint not null,
  constraint data_event_pk primary key (id),
  constraint data_event_fk_type_event foreign key (type_event_id) references followup.type_event (id)
);
*/

-- select * from information_schema.tables where table_schema = 'followup';
-- select * from followup.user;
-- 
-- use followup;
-- show tables;
-- 
-- create table a (a integer);
-- drop table a;
-- drop table test;
-- 
-- select table_name from information_schema.tables where table_schema = 'followup';