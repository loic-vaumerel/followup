drop database if exists followup;
drop user if exists web_followup;

create user if not exists followup_ro identified by 'password';
create user if not exists followup_rw identified by 'password';
create database if not exists followup;

grant select on followup.* to followup_ro;
grant select, insert, update, delete on followup.* to followup_rw;

show databases;
select * from mysql.user;
show grants for followup_ro;
show grants for followup_rw;


