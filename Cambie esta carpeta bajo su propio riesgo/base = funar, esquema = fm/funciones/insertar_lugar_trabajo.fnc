create or replace function insertar_lugar_trabajo(nom varchar2)return number
is
idd number;
begin
  insert into lugar_trabajo(id_lugar_trabajo, nombre)
  values (s_lugar_trabajo.nextval, nom);
  return s_lugar_trabajo.currval;
end;
/
