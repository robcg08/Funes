create or replace function insertar_id_direccion(pais number,provincia number,canton number
, distrito number, barrio number,adicional varchar2) return number
is
direccionn number;
begin
  insert into direccion(id_direccion, id_barrio, id_distrito, id_canton, id_provincia, id_pais, adicional)
  values(s_direccion.nextval, barrio, distrito, canton, provincia, pais,adicional);
  return (s_direccion.currval);
end;
/
