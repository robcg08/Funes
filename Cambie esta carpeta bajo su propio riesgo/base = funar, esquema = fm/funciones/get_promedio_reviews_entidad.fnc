create or replace function get_promedio_reviews_entidad(id number) return number
is promedio number(8,2);
total number(8);
suma number(8);
begin
  select sum(calificacion) into suma from review inner join review_entidad  on review.id_review = review_entidad.id_review where review_entidad.id_entidad = id ;
  select count(calificacion) into total from review inner join review_entidad  on review.id_review = review_entidad.id_review where review_entidad.id_entidad = id ;
  IF total = 0 THEN
      promedio:= 0;
   ELSE
      promedio := suma / total;

   END IF;
  
  dbms_output.put_line(promedio);
  return promedio;
end;
/
