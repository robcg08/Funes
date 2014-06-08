--
-- Creación de tablespace
--
-- GE: DATA
CREATE TABLESPACE FM_Data
DATAFILE 'C:\app\SleyterAngulo\oradata\funar\fmdata01.dbf'
SIZE 10M
REUSE
AUTOEXTEND ON
NEXT 512k
MAXSIZE 200M;
--
-- GE: INDEX
CREATE TABLESPACE FM_Ind
DATAFILE 'C:\app\SleyterAngulo\oradata\funar\fmind01.dbf'
SIZE 10M
REUSE
AUTOEXTEND ON
NEXT 512k
MAXSIZE 200M;
