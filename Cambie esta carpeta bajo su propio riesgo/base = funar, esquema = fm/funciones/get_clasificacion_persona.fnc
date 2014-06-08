create or replace function get_clasificacion_persona(estrella number,cedula number) return number
is clasi number(8);
begin
  select count(calificacion) into clasi from review inner join review_persona  on review.id_review = review_persona.id_review where review_persona.cedula = cedula and review.calificacion = estrella;
  dbms_output.put_line(clasi);
  return clasi;
end;
/
