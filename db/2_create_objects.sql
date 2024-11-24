drop table if exists followup.action_category;
drop table if exists followup.category;
drop table if exists followup.action;
drop table if exists followup.type_position;
drop table if exists followup.type_action_category;
drop table if exists followup.type_category;
drop table if exists followup.type_action;
drop table if exists followup.person;
drop table if exists followup.user;

create table followup.user (
  id bigint not null auto_increment,
  name text not null,
  email text,
  password text not null,
  active bool not null,
  admin bool not null,
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

create table followup.type_action_category (
  id bigint not null auto_increment,
  type_action_id bigint not null,
  type_category_id bigint not null,
  constraint action_category_pk primary key (id),
  constraint action_category_fk_type_action_id foreign key (type_action_id) references type_action (id),
  constraint action_category_fk_type_category_id foreign key (type_category_id) references type_category (id)
);

create table followup.type_position (
  id bigint not null auto_increment,
  name varchar (250) not null,
  constraint type_position_pk primary key (id),
  constraint type_position_uk_name unique (name)
);

create table followup.action (
  id bigint not null auto_increment,
  date datetime not null,
  type_action_id bigint not null,
  type_position_id bigint not null,
  quantity bigint,
  unit text,
  constraint action_pk primary key (id),
  constraint action_fk_type_action_id foreign key (type_action_id) references type_action (id),
  constraint action_fk_type_position_id foreign key (type_position_id) references type_position (id)
);

-- insert into followup.user values (1, 'admin', null, 'NOT_INITIALIZED', true, true);
-- insert into followup.user values (null, 'user1', null, 'NOT_INITIALIZED', false, true);
-- 
-- insert into followup.person values (1, 'bob');
-- insert into followup.person values (2, 'alice');
-- 
-- insert into followup.type_action values (1, 2, 'is doing A to', 1);
-- insert into followup.type_action values (2, 2, 'is doing B to', 1);
-- insert into followup.type_action values (3, 1, 'is doing C to', 2);
-- insert into followup.type_action values (4, 1, 'is doing D to', 1);
-- insert into followup.type_action values (5, 2, 'is doing E to', 2);
-- 
-- insert into followup.type_category values (1, 1, ' category 1');
-- insert into followup.type_category values (2, 1, ' category 2');
-- insert into followup.type_category values (3, 1, ' category 3');
-- insert into followup.type_category values (4, 1, ' category 4');
-- insert into followup.type_category values (5, 1, ' category 5');
-- 
-- insert into followup.type_action_category values (null, 1, 1);
-- insert into followup.type_actipassword changed to the default valueon_category values (null, 1, 2);
-- insert into followup.type_action_category values (null, 2, 3);
-- insert into followup.type_action_category values (null, 3, 3);
-- insert into followup.type_action_category values (null, 4, 5);
-- 
-- insert into followup.action values (null, now () - interval 30 minute, 1, 100, 'times');

select * from information_schema.tables where table_schema = 'followup';
select * from information_schema.table_constraints where table_schema = 'followup' or constraint_schema = 'followup';


select * from followup.user;
select * from followup.person;
select * from followup.type_action;
select * from followup.type_category;
select * from followup.type_action_category;
select * from followup.type_position;
select * from followup.action;
-- select * from followup.event;

select ta.id, concat (g.name, ' ', ta.name, ' ', r.name) as action_name, GROUP_CONCAT (tc.name order by tc.name separator ',') as categories
  from followup.type_action ta
  left outer join followup.person g
    on g.id = ta.giver_id
  left outer join followup.person r
    on r.id = ta.receiver_id
  left outer join followup.type_action_category tac
    on tac.type_action_id = ta.id
  left outer join followup.type_category tc
    on tc.id = tac.type_category_id
 group by g.name, ta.name, r.name
 order by g.name, ta.name, r.name;


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