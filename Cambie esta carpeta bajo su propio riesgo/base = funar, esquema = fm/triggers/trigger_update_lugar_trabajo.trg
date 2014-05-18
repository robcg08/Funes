CREATE OR REPLACE TRIGGER trigger_update_lugar_trabajo
before update on lugar_trabajo for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
END;
/
