create or replace function get_total_reviews_persona(cedula number) return number
is total number(8);
begin
  select count(calificacion) into total from review inner join review_persona  on review.id_review = review_persona.id_review where review_persona.cedula = cedula ;
  return total;
end;
/
