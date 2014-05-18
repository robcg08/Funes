create or replace function insertar_review(text varchar2, calif number)return number
is
idd number;
begin
  insert into review (id_review, review, calificacion)
  values (s_review.nextval, text, calif);
  return s_review.currval;
end;
/
