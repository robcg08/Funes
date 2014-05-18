CREATE OR REPLACE TRIGGER trigger_insert_barrio
before insert on barrio for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
      :new.fec_creacion := sysdate;
      :new.usuario_creacion := 'FM';
END;
/
