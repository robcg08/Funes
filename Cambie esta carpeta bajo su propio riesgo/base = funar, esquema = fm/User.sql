CREATE USER fm 
IDENTIFIED BY fm 
DEFAULT TABLESPACE fm_data 
QUOTA 10M ON fm_data 
TEMPORARY TABLESPACE temp
QUOTA 5M ON system 
--PROFILE app_user 
--PASSWORD EXPIRE;
--------------------------------------------------
create ROLE FM
IDENTIFIED BY fm; 
-------------------------------------------------- 
GRANT CONNECT TO fm;
--------------------------------------------------
--GRANT EXECUTE on schema.procedure TO username;
--------------------------------------------------
grant create public synonym to FM;
--------------------------------------------------
grant create session to FM;
grant create table to FM;
grant create view to FM;
grant CREATE ANY INDEX to FM;
grant DROP PUBLIC SYNONYM to FM;
GRANT UNLIMITED TABLESPACE TO FM;
