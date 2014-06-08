create or replace function get_promedio_reviews_persona(cedula number) return number
is promedio number(8,2);
total number(8);
suma number(8);
begin
  select sum(calificacion) into suma from review inner join review_persona on review.id_review = review_persona.id_review where review_persona.cedula = cedula ;
  select count(calificacion) into total from review inner join review_persona  on review.id_review = review_persona.id_review where review_persona.cedula = cedula ;  
   IF total = 0 THEN
      promedio:= 0;
   ELSE
      promedio := suma / total;

   END IF;
  
  dbms_output.put_line(promedio);
  return promedio;
end;
/
