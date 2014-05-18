create or replace function get_id_entidad(nom varchar2, direcc number) return number
is
id_ent number;
begin
  select id_entidad
  into id_ent
  from entidad
  where nombre = nom and id_direccion = direcc;
  return (id_ent);
end;
/
