create or replace function get_reportes(usua varchar) return number
is
ban number;
begin
  select reportes
  into ban
  from usuario
  where usuario = usua;
  return ban;
end;
/
