CREATE OR REPLACE TRIGGER trigger_insert_lugar_trabajo
before insert on lugar_trabajo for each row
BEGIN
      :new.fec_ultima_modificacion := sysdate;
      :new.usuario_ultima_modificacion := 'FM';
      :new.fec_creacion := sysdate;
      :new.usuario_creacion := 'FM';
END;
/
