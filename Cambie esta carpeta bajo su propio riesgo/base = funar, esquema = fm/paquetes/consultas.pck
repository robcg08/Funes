create or replace package consultas is
function get_categorias(ad number)return SYS_REFCURSOR;
function get_persona_nombre(nom varchar2)return SYS_REFCURSOR;
function get_persona_cedula(ced number)return SYS_REFCURSOR;
function get_persona_apellido(ape varchar2)return SYS_REFCURSOR;
function get_persona_segundo_apellido(ape2 varchar2)return SYS_REFCURSOR;
function get_entidad_nombre(nom varchar2)return SYS_REFCURSOR;
function get_entidad_cedula(ced number)return SYS_REFCURSOR;
function get_persona_categoria(nom varchar2)return SYS_REFCURSOR;
end consultas;
/
create or replace package body consultas is

function get_categorias(ad number)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select categoria.nombre from categoria
    order by nombre;
    return el_cursor;
  end;
function get_persona_nombre(nom varchar2)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select cedula, nombre, primer_apellido, segundo_apellido
    from persona
    where nombre like '%' ||  nom || '%';
    return el_cursor;
  end;
function get_persona_cedula(ced number)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select cedula, nombre, primer_apellido, segundo_apellido
    from persona
    where cedula like '%' ||  ced || '%';
    return el_cursor;
  end;
function get_persona_apellido(ape varchar2)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select cedula, nombre, primer_apellido, segundo_apellido
    from persona
    where primer_apellido like '%' ||  ape || '%';
    return el_cursor;
  end;
function get_persona_segundo_apellido(ape2 varchar2)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select cedula, nombre, primer_apellido, segundo_apellido
    from persona
    where segundo_apellido like '%' ||  ape2 || '%';
    return el_cursor;
  end;
function get_entidad_nombre(nom varchar2)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select entidad.cedula_juridica, nombre
    from entidad
    where nombre like '%' ||  nom || '%';
    return el_cursor;
  end;
function get_entidad_cedula(ced number)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select cedula_juridica, nombre
    from entidad
    where cedula_juridica like '%' ||  ced || '%';
    return el_cursor;
  end;
function get_persona_categoria(nom varchar2)return SYS_REFCURSOR
  is
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select persona.cedula, persona.nombre, persona.primer_apellido, persona.segundo_apellido
    from categoriaxpersona
    inner join persona
    on persona.cedula = categoriaxpersona.cedula
    inner join categoria
    on categoria.id_categoria = categoriaxpersona.id_categoria
    where categoria.nombre like '%' ||  nom || '%';
    return el_cursor;
  end;
end consultas;
/
