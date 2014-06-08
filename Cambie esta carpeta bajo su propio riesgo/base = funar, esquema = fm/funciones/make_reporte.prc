create or replace procedure make_reporte (id_usuario varchar2) is
reportee number(11);
bloqueoo number(11);
parametroo number(11);

BEGIN
 select reportes
 into reportee
 from usuario
 where usuario = id_usuario;
 
 select bloqueos
    into bloqueoo
    from usuario
    where usuario = id_usuario;

 select parametro
 into parametroo
 from parametrizable
 where nombre_parametro = 'reportes';

  if reportee = parametroo-1 then
    update usuario
    set reportes = 0
    where usuario = id_usuario;

    update usuario
    set bloqueos = bloqueoo+1
    where usuario = id_usuario;
    
    select bloqueos
    into bloqueoo
    from usuario
    where usuario = id_usuario;

    if bloqueoo = 1 then
      insert into bloqueo(id_bloqueo,fecha_caducacion,usuario)
      values (s_bloqueo.nextval,sysdate+7,id_usuario);

      update usuario
      set bloqueado = 'si'
      where usuario = id_usuario;
    elsif bloqueoo = 2 then
      insert into bloqueo(id_bloqueo,fecha_caducacion,usuario)
      values (s_bloqueo.nextval,sysdate+30,id_usuario);
      update usuario
      set bloqueado  = 'di'
      where usuario = id_usuario;
    else
      update usuario
      set bloqueado = 'si'
      where usuario = id_usuario;
    END IF;

  else
    update usuario
    set reportes = reportee+1
    where usuario = id_usuario;
    
    insert into reporte (id_reporte,usuario)
    values (s_reporte.nextval,id_usuario);
    
  end if;

END;
/
