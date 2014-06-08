create or replace function get_total_reviews_entidad(id number) return number
is total number(8);
begin
  select count(calificacion) into total from review inner join review_entidad  on review.id_review = review_entidad.id_review where review_entidad.id_entidad = id ;
  return total;
end;
/
