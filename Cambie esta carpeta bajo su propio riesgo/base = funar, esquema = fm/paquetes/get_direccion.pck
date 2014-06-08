create or replace package get_direccion is
function get_pais(idd number)return varchar2;
function get_provincia(idd number)return varchar2;
function get_canton(idd number)return varchar2;
function get_distrito(idd number)return varchar2;
function get_barrio(idd number)return varchar2;
function get_direccion(idd varchar2)return SYS_REFCURSOR;
end get_direccion;
/
create or replace package body get_direccion is
function get_pais(idd number)return varchar2
  as
  nom varchar(10);
  begin
    select nombre
    into nom
    from pais
    where id_pais = idd;
    return nom;
  end;
function get_provincia(idd number)return varchar2
  as
  nom varchar(10);
  begin
    select nombre
    into nom
    from provincia
    where id_provincia = idd;
    return nom;
  end;
function get_canton(idd number)return varchar2
  as
  nom varchar(10);
  begin
    select nombre
    into nom
    from canton
    where id_canton = idd;
    return nom;
  end;
function get_distrito(idd number)return varchar2
  as
  nom varchar(10);
  begin
    select nombre
    into nom
    from distrito
    where id_distrito = idd;
    return nom;
  end;
function get_barrio(idd number)return varchar2
  as
  nom varchar(10);
  begin
    select nombre
    into nom
    from barrio
    where id_barrio = idd;
    return nom;
  end;
function get_direccion(idd varchar2)return SYS_REFCURSOR
  as
  el_cursor SYS_REFCURSOR;
  begin
    open el_cursor for
    select direccion.id_pais,direccion.id_provincia,direccion.id_canton,direccion.id_distrito,direccion.id_barrio
    from direccion
    inner join entidad
    on direccion.id_direccion = entidad.id_direccion
    where entidad.id_entidad=idd;
    return el_cursor;
  end;
    
end get_direccion;
/
