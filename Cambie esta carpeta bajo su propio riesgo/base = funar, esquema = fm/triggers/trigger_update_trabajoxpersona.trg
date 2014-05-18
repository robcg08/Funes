CREATE OR REPLACE TRIGGER trigger_update_trabajoxpersona
before update on trabajoxpersona for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
END;
/
