CREATE OR REPLACE TRIGGER trigger_update_cargo
before update on cargo for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
END;
/
