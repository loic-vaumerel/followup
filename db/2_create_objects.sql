drop table if exists followup.data_event;
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

select * from information_schema.tables where table_schema = 'followup';
select * from followup.user;
-- 
-- use followup;
-- show tables;
-- 
-- create table a (a integer);
-- drop table a;
-- drop table test;
-- 
-- select table_name from information_schema.tables where table_schema = 'followup';