create or replace function desbloqueo(nada number)return sys_refcursor
is
el_cursor SYS_REFCURSOR;
begin
  OPEN el_cursor for
  select fecha_caducacion
  from bloqueo
  where to_date(fecha_caducacion,'DD/MM/YYYY') = to_date(sysdate, 'DD/MM/YYYY');
  return  el_cursor;
end;
/
