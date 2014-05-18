CREATE OR REPLACE TRIGGER trigger_insert_categoriaxperso
before insert on categoriaxpersona for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
      :new.fec_creacion := sysdate;
      :new.usuario_creacion := 'FM';
END;
/
