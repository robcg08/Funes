create or replace function get_clasificacion_entidad(estrella number,id number) return number
is clasi number(8);
begin
  select count(calificacion) into clasi from review inner join review_entidad  on review.id_review = review_entidad.id_review where review_entidad.id_entidad = id and review.calificacion = estrella;
  dbms_output.put_line(clasi);
  return clasi;
end;
/
