create or replace function get_id_entidad(nom varchar2, ced_jur number) return number
is
id_ent number;
begin
  select id_entidad
  into id_ent
  from entidad
  where nombre = nom and entidad.cedula_juridica = ced_jur;
  return (id_ent);
end;
/
