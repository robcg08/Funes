create or replace function insertar_cargo(nom varchar2, id_lugar number)return number
is
idd number;
begin
  insert into cargo(id_cargo, nombre, id_lugar_trabajo)
  values (s_cargo.nextval, nom, id_lugar);
  return s_cargo.currval;
end;
/
