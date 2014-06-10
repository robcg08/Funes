create or replace function get_nom_entidad (idd number)return varchar2
is
nom varchar2(100);
begin
  select nombre
  into nom
  from entidad
  where id_entidad = idd;
  return nom;
 end;
/
